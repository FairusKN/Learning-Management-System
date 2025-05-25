FROM php:8.4.6-fpm

# System & PHP deps
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libjpeg-dev libonig-dev \
    libxml2-dev libfreetype6-dev libwebp-dev libxrender1 libfontconfig1 \
    libxext6 default-mysql-client \
    libreoffice \
    nodejs npm \
    && docker-php-ext-install intl pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Fix LibreOffice dconf cache permission
RUN mkdir -p /var/www/.cache/dconf \
    && chown -R www-data:www-data /var/www/.cache

# Install fish shell
RUN apt-get install -y fish

# Node setup
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && npm install -g npm

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN chmod 1777 /tmp
RUN chown -R www-data:www-data /var/www

CMD ["php-fpm"]
