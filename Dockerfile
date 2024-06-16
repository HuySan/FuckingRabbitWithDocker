FROM alpine:3.19.1

ENV TZ=Asia/Almaty

RUN apk --no-cache add \
    php82 \
    php82-fpm \
    php82-json \
    php82-mbstring \
    php82-phar \
    php82-openssl \
    php82-pdo \
    php82-pdo_mysql \
    php82-session \
    php82-zip \
    php82-curl \
    php82-iconv \
    php82-tokenizer \
    php82-dom \
    php82-xml \
    php82-fileinfo \
    php82-xmlwriter \
    composer \
    curl \
    git \
    unzip \
    vladimir-yuldashev/laravel-queue-rabbitmq\
    nginx

COPY nginx/nginx.conf /etc/nginx/http.d/service.conf
COPY ./core-test /var/www/core-test

WORKDIR /var/www/core-test

# Установка Composer и зависимостей Laravel
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install

# Настройка прав
RUN chown -R www-data:www-data /var/www/core-test/storage /var/www/core-test/bootstrap/cache
RUN chmod -R 775 /var/www/core-test/storage /var/www/core-test/bootstrap/cache

#RUN which php-fpm
RUN rm -f /etc/nginx/http.d/default.conf

CMD sh -c "php-fpm82 -F -R & nginx -g 'daemon off;'"
