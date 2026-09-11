FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk update && apk add --no-cache \
    bash \
    curl \
    git \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    icu-dev \
    postgresql-dev \
    oniguruma-dev \
    linux-headers \
    $PHPIZE_DEPS

# Configure and install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        intl \
        mbstring \
        pdo \
        pdo_pgsql \
        pgsql \
        zip \
        opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application
COPY . .

# Set permissions for CodeIgniter writable directory
RUN chown -R www-data:www-data /var/www/html/writable \
    && chmod -R 775 /var/www/html/writable

EXPOSE 9000

CMD ["php-fpm"]
