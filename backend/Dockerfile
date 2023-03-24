FROM php:8.2

RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

WORKDIR /app/backend

COPY . .

RUN composer install


EXPOSE 8000

CMD php artisan serve --host=0.0.0.0
