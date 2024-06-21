FROM php:8.2-fpm-alpine AS editor

WORKDIR /srv

RUN chown -R www-data:www-data /srv

# Install Composer
RUN apk add --no-cache curl make && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN make prod
EXPOSE 80

CMD ["sh", "-c", "make prod && php-fpm"]




FROM nginx:1.23.4-alpine3.17 AS proxy
COPY proxy/nginx.conf /etc/nginx/nginx.conf
