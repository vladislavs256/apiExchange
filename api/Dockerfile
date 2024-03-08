# api/Dockerfile
FROM php:8.3-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
          && docker-php-ext-install pdo pdo_pgsql



# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the application files
COPY ./ /var/www/html/
COPY public/ /var/www/html/public
COPY composer.json composer.lock /var/www/html/

# Set working directory
WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-scripts --no-autoloader

RUN composer dump-autoload --optimize
