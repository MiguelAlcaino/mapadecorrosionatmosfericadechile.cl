# Despliegue — Mapa de Corrosión Atmosférica de Chile

App **Symfony 1.x** (fork [FriendsOfSymfony1](https://github.com/FriendsOfSymfony1/symfony1)) corriendo en **PHP 8.4**, dockerizada. Este documento describe el entorno de desarrollo local y el de producción.

## Ramas

| Rama | Stack | Uso |
|------|-------|-----|
| `main` | PHP 7.0 + nginx 1.10 + MySQL 5.7 | Baseline fiel al servidor viejo (DigitalOcean) |
| `php8.4` | PHP 8.4 + fork symfony1 + nginx stable | **Producción actual** (Raspberry Pi) |

## Arquitectura (producción)

```
Internet
   │
   ▼
Cloudflare  (DNS + SSL + edge)
   │  túnel saliente (sin abrir puertos)
   ▼
cloudflared  [servicio systemd, nativo en el Pi]
   ▼
nginx  [contenedor docker] ──► php-fpm 8.4  [contenedor docker]
                                     │  host.docker.internal → IP LAN del Pi
                                     ▼
                              MariaDB  [nativa en el host, systemd]
```

- **App web (nginx + php):** contenedores vía `docker compose`.
- **Base de datos (MariaDB):** nativa en el host (compartible entre varios proyectos).
- **Túnel (cloudflared):** servicio systemd nativo.

---

## Componentes / versiones

- **App:** Symfony **1.4.x** reemplazado por el fork `friendsofsymfony1/symfony1:^1.5` + `friendsofsymfony1/doctrine1:^1.4` (vía Composer). ORM: Doctrine 1.2.
- **PHP:** 8.4-fpm (imagen propia, `docker/php/Dockerfile`) con `pdo_mysql`, `mbstring`, Composer.
- **Web:** nginx (contenedor), config en `docker/nginx/default.conf`.
- **BD:** MySQL 5.7 en dev (Mac) / **MariaDB** en el Pi (no hay imagen `mysql:5.7` para ARM64).
- **App name:** `frontend`, entorno `prod`. Web root: `public_html/`.

---

## Entorno de desarrollo local (Mac / amd64)

Requisitos: Docker + Docker Compose.

```bash
# 1. Config de BD (host = servicio 'db' del compose)
cp config/databases.yml.dist config/databases.yml

# 2. Dump de la BD + dirs escribibles
mkdir -p docker/db/init cache log && chmod 777 cache log
cp /ruta/al/mapa-db-backup.sql.gz docker/db/init/     # mysql lo carga en el primer boot

# 3. Dependencias (rama php8.4)
docker compose build php
docker compose run --rm -w /var/www/mapadecorrosionatmosfericadechile.cl php composer install

# 4. Levantar
docker compose up -d
```

Sitio local: <http://localhost:8080>

> En `main` (PHP 7.0) el `docker-compose.yml` usa `nginx:1.10` (a propósito: el Symfony 1.4.5 bundled emite un header malformado por el modificador `/e` de `preg_replace`, removido en PHP 7.0; nginx moderno lo rechaza con 502, nginx 1.10 lo tolera). El fork en `php8.4` corrige ese bug, por eso ahí se usa `nginx:stable`.

---

## Producción — Raspberry Pi 5 (aarch64, Debian 13)

Acceso SSH: alias `rpi5`. Proyecto en `/home/mao/mapadecorrosionatmosfericadechile.cl`.

### Rutas clave

| Ruta | Qué es |
|------|--------|
| `~/mapadecorrosionatmosfericadechile.cl/` | Proyecto (código + imágenes) |
| `~/mapadecorrosionatmosfericadechile.cl/docker-compose.yml` | Contenedores (sin servicio `db`; php con `extra_hosts`) |
| `~/mapadecorrosionatmosfericadechile.cl/config/databases.yml` | Conexión → `host.docker.internal` |
| `/etc/cloudflared/config.yml` | Definición operativa del túnel (la que usa el servicio) |
| `/etc/cloudflared/<UUID>.json` | Credenciales del túnel |
| `~/.cloudflared/` | Copia del config + `cert.pem` de autorización de la zona |
| `/var/lib/mysql` | Datos de MariaDB (BD `mapadeco_innova`) |
| `~/.mapa_dbpass` | Contraseña del usuario `mapadeco` de la BD |

### Diferencias vs. el compose base (ARM + BD en host)

`docker-compose.yml` del Pi: **sin servicio `db`**, `restart: unless-stopped`, y el servicio `php` con:
```yaml
    extra_hosts:
      - "host.docker.internal:192.168.68.69"   # IP LAN del Pi → MariaDB del host
```
> **Por qué la IP LAN y no `localhost`:** Docker corre en modo **rootless** con `--disable-host-loopback`, así que los contenedores **no** llegan al `127.0.0.1` del host. Sí llegan a la IP de LAN. Por eso `databases.yml` usa `host.docker.internal` mapeado a `192.168.68.69`.
>
> ⚠️ Conviene una **reserva DHCP** para el Pi (192.168.68.69); si el router le cambia la IP, el contenedor pierde la BD.

### Reproducir el despliegue en el Pi

```bash
# 0. Docker rootless activo (ya configurado con linger)
#    Requiere docker-ce + containerd.io instalados (containerd NO se puede desinstalar,
#    docker-ce depende de él y contiene el binario dockerd).

# 1. Copiar el proyecto (desde el Mac)
rsync -az --exclude vendor/ --exclude 'cache/*' --exclude 'log/*' \
  ./ rpi5:mapadecorrosionatmosfericadechile.cl/

# 2. MariaDB en el host
sudo apt-get install -y mariadb-server
sudo sed -i 's/^bind-address.*/bind-address = 0.0.0.0/' /etc/mysql/mariadb.conf.d/50-server.cnf
sudo systemctl restart mariadb
sudo mariadb -e "CREATE DATABASE mapadeco_innova CHARACTER SET utf8;
  CREATE USER 'mapadeco'@'%' IDENTIFIED BY '<PASS>';
  GRANT ALL ON mapadeco_innova.* TO 'mapadeco'@'%'; FLUSH PRIVILEGES;"
zcat docker/db/init/mapa-db-backup.sql.gz | sudo mariadb mapadeco_innova

# 3. databases.yml (host.docker.internal), build, deps, up
cp config/databases.yml.dist config/databases.yml   # editar host → host.docker.internal + pass
mkdir -p cache log && chmod 777 cache log
docker compose build php
docker compose run --rm -w /var/www/mapadecorrosionatmosfericadechile.cl php composer install
docker compose up -d
```

### Imágenes (fuera de git)

`public_html/{images/mapas,imagenes,uploads}` están en `.gitignore` (datos pesados: ~270M). Se sincronizan aparte del servidor:
```bash
# ej. del droplet viejo al Pi (o via Mac)
rsync -avz malcaino@<server>:.../public_html/{imagenes,uploads}/ ./public_html/<dir>/
```
Los assets de UI chicos (`public_html/images/*.gif|png` — menú, flechas) **sí** están versionados.

---

## Cloudflare Tunnel

Túnel `mapa` (UUID en `/etc/cloudflared/config.yml`). DNS del dominio administrado por Cloudflare (nameservers `josh/meadow.ns.cloudflare.com`).

`/etc/cloudflared/config.yml`:
```yaml
tunnel: <UUID>
credentials-file: /etc/cloudflared/<UUID>.json
ingress:
  - hostname: mapadecorrosionatmosfericadechile.cl
    service: http://localhost:8080
  - hostname: www.mapadecorrosionatmosfericadechile.cl
    service: http://localhost:8080
  - service: http_status:404
```

Montaje (una vez):
```bash
cloudflared tunnel login                      # autorizar la zona en el navegador
cloudflared tunnel create mapa
# escribir config.yml + rutear DNS:
cloudflared tunnel route dns mapa mapadecorrosionatmosfericadechile.cl
cloudflared tunnel route dns mapa www.mapadecorrosionatmosfericadechile.cl
sudo cloudflared service install               # servicio systemd (auto-arranque)
```
> El apex no admite CNAME normal; si `route dns` choca con un A existente, borrar el A en el dashboard y re-rutear. Cloudflare hace "CNAME flattening" en el apex.

**No requiere abrir puertos** (el túnel es una conexión saliente; inmune a doble-NAT / IP dinámica).

---

## Operación

```bash
# App (desde ~/mapadecorrosionatmosfericadechile.cl)
docker compose ps
docker compose logs -f php
docker compose restart
docker compose up -d --build            # tras cambios de código/Dockerfile

# Limpiar cache de symfony (tras cambios de config)
rm -rf cache/*

# Túnel y BD
systemctl status cloudflared
cloudflared tunnel info mapa
systemctl status mariadb
sudo mariadb mapadeco_innova

# Backup de la BD
sudo mariadb-dump --no-tablespaces --single-transaction mapadeco_innova | gzip > backup-$(date +%F).sql.gz
```

## Auto-arranque

Todo vuelve solo tras reinicio / corte de luz:
- Docker rootless: `loginctl enable-linger` + contenedores con `restart: unless-stopped`.
- `mariadb` y `cloudflared`: servicios systemd habilitados.

## Notas / gotchas

1. **`mysql:5.7` no existe para ARM64** → en el Pi se usa **MariaDB** (importa el dump de MySQL sin problema).
2. **Rootless + loopback**: los contenedores no ven `127.0.0.1` del host → BD por IP LAN.
3. **`/e` en `normalizeHeaderName`** (Symfony 1.4.5) rompe en PHP 7.0 → el fork lo corrige (por eso PHP 8.4 usa nginx moderno).
4. **`gd`** está diferido (solo lo usa `sfThumbnailPlugin`); si se necesitan thumbnails, agregarlo al `Dockerfile` (en php:8.4 requiere `libpng/jpeg` vía apt).
5. La definición **operativa** del túnel es la de `/etc/cloudflared/` (no la de `~/.cloudflared/`).
