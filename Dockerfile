FROM public.ecr.aws/docker/library/caddy:2.8.4-builder AS caddy-builder

RUN xcaddy build --with github.com/baldinof/caddy-supervisor

FROM public.ecr.aws/docker/library/php:8.3-fpm

RUN apt update && apt install -y libpq-dev libxml2-dev libzip-dev busybox-static
RUN docker-php-ext-install pgsql pdo_pgsql xml zip
RUN docker-php-ext-enable opcache

COPY --from=public.ecr.aws/docker/library/composer:2 /usr/bin/composer /usr/bin/composer

COPY ./Caddyfile /etc/caddy/Caddyfile
COPY --from=caddy-builder /usr/bin/caddy /usr/bin/caddy

COPY . /var/www/html
WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html
RUN chmod a+w /var/www/html/storage
RUN composer install --working-dir=/var/www/html

EXPOSE 8002
CMD ["caddy", "run", "--config", "/etc/caddy/Caddyfile"]
