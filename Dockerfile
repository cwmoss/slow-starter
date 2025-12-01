FROM ghcr.io/shyim/wolfi-php/base:latest

RUN <<EOF
set -eo pipefail
apk add --no-cache frankenphp-8.4 php-frankenphp-8.4 \
    php-frankenphp-8.4-curl \
    php-frankenphp-8.4-mbstring php-frankenphp-8.4-iconv \
    php-frankenphp-8.4-openssl \
    php-frankenphp-8.4-gd php-frankenphp-8.4-pdo php-frankenphp-8.4-pdo_sqlite \
    php-frankenphp-8.4-dom php-frankenphp-8.4-intl php-frankenphp-8.4-mbstring php-frankenphp-8.4-openssl \
    php-frankenphp-8.4-phar php-frankenphp-8.4-curl php-frankenphp-8.4-sockets php-frankenphp-8.4-xml php-frankenphp-8.4-xmlwriter \
    php-frankenphp-8.4-fileinfo php-frankenphp-8.4-exif php-frankenphp-8.4-posix \
    php-frankenphp-8.4-ffi libvips curl

adduser -u 82 www-data -D
EOF

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ENV TERM=xterm-256color

WORKDIR /app
USER www-data
EXPOSE 8001 8002 8003
#ENTRYPOINT [ "/bin/sh"]
ENTRYPOINT [ "/usr/bin/frankenphp", "run" ]
CMD [ "--config", "/etc/caddy/Caddyfile" ]