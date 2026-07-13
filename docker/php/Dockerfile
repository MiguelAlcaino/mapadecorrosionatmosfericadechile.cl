FROM php:7.0-fpm

# Extensions required to boot the Symfony 1.4 app on PHP 7.0.
# pdo_mysql (Doctrine <-> MySQL) and mbstring build without extra apt libs on 7.0.
# gd (sfThumbnailPlugin thumbnails) is intentionally deferred to the images phase.
RUN docker-php-ext-install pdo_mysql mbstring

# Symfony 1.4 templates rely on short open tags; match prod PHP config.
RUN { echo "short_open_tag = On"; echo "date.timezone = America/Santiago"; } \
      > /usr/local/etc/php/conf.d/zz-app.ini
