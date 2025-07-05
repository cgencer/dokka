FROM drupal:7.103-apache

# Install required PHP extensions and tools
RUN apt-get update && apt-get install -y \
    vim \
    git \
    unzip \
    libicu-dev \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    zlib1g-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl \
    && rm -rf /var/lib/apt/lists/*

# Configure PHP
RUN echo "memory_limit = 256M" > /usr/local/etc/php/conf.d/memory-limit.ini \
    && echo "upload_max_filesize = 64M" > /usr/local/etc/php/conf.d/upload-limit.ini \
    && echo "post_max_size = 64M" >> /usr/local/etc/php/conf.d/upload-limit.ini

# Install PHP extensions needed by Drupal
RUN docker-php-ext-install pdo pdo_mysql zip intl

# Enable Apache mods commonly needed by Drupal
RUN a2enmod rewrite

# Install Composer (from the Composer official image)
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Install Drush globally via Composer
RUN composer global require drush/drush:8.*

# Ensure Drush is on PATH
ENV PATH="/root/.composer/vendor/bin:${PATH}"

# Set the container working directory
WORKDIR /var/www/html

# Ensure the Apache user (www-data) owns the web root
RUN chown -R www-data:www-data /var/www/html
