FROM php:8.2-fpm-alpine AS editor

WORKDIR /srv

RUN chown -R www-data:www-data /srv

# Install Composer
RUN apk add --no-cache curl && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN make prod

 CMD ["make", "server-prod"]
EXPOSE 80

# Specify the default command to run on container start
CMD ["php-fpm"]


FROM nginx:1.23.4-alpine3.17 AS proxy
COPY proxy/nginx.conf /etc/nginx/nginx.conf
