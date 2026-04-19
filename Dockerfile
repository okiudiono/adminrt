# Use the PHP 8.3 FPM Alpine base image
FROM php:8.1-fpm

# Verifikasi instalasi Composer
# RUN composer --version

# Setel izin untuk Composer
# RUN chmod +x /usr/local/bin/composer

# Run composer dump-autoload
# Install dependencies for PHP extensions and other tools
RUN set -eux; \
    apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y --no-install-recommends \
    curl \
    libmemcached-dev \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libssl-dev \
    libwebp-dev \
    libxpm-dev \
    libmcrypt-dev \
    libonig-dev; \
    rm -rf /var/lib/apt/lists/*

RUN \
    # Install the PHP pdo_mysql extention
    # docker-php-ext-install pdo_mysql; \
    # Install the PHP pdo_pgsql extention
    # docker-php-ext-install pgsql pdo_pgsql; \
    # Install the PHP gd library
    docker-php-ext-configure gd \
    --prefix=/usr \
    --with-jpeg \
    --with-webp \
    --with-xpm \
    --with-freetype; \
    docker-php-ext-install gd; \
    php -r 'var_dump(gd_info());'

# Set working directory
WORKDIR /var/www/html

# Expose port 9000 (if needed) and start php-fpm server
EXPOSE 9001
CMD ["php-fpm"]