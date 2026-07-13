FROM php:8.4-fpm

# php:8.4-fpm is on modern Debian, so apt works normally (no archive.debian.org fix needed).
# mbstring on 8.4 needs oniguruma; pdo_mysql needs no extra libs.
RUN apt-get update \
    && apt-get install -y --no-install-recommends libonig-dev git unzip \
    && docker-php-ext-install pdo_mysql mbstring \
    && rm -rf /var/lib/apt/lists/*

# Symfony 1.x templates rely on short open tags. Suppress PHP 8 deprecation/notice
# noise (legacy symfony 1.x emits many at bootstrap) so it doesn't corrupt output;
# real warnings/errors still display for debugging the migration.
RUN { \
      echo "short_open_tag = On"; \
      echo "date.timezone = America/Santiago"; \
      echo "display_errors = On"; \
      echo "error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE"; \
      echo "log_errors = On"; \
    } > /usr/local/etc/php/conf.d/zz-app.ini

# Composer (to install the FriendsOfSymfony1 fork into the mounted project vendor/).
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
