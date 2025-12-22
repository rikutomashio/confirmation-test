FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
  libzip-dev zip unzip git \
  && docker-php-ext-install pdo pdo_mysql zip mbstring

WORKDIR /var/www

FROM php:8.1-fpm

# 必要なライブラリをインストール
RUN apt-get update && apt-get install -y \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libpng-dev \
  libzip-dev \
  zip \
  unzip \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install gd pdo pdo_mysql zip
