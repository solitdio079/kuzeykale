FROM php:7.2-apache

# Enable Apache rewrite
RUN a2enmod rewrite

# Install dependencies
RUN apt-get update && apt-get install -y curl \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# ----------------------------
# Install ionCube Loader (PHP 7.2 ONLY)
# ----------------------------
RUN set -eux; \
    PHP_EXT_DIR="$(php -r 'echo ini_get("extension_dir");')"; \
    curl -fsSL https://downloads.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz -o /tmp/ioncube.tar.gz; \
    tar -xzf /tmp/ioncube.tar.gz -C /tmp; \
    cp /tmp/ioncube/ioncube_loader_lin_7.2.so "$PHP_EXT_DIR/"; \
    echo "zend_extension=$PHP_EXT_DIR/ioncube_loader_lin_7.2.so" > /usr/local/etc/php/conf.d/00-ioncube.ini; \
    rm -rf /tmp/ioncube /tmp/ioncube.tar.gz

# Copy app
COPY . /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html
EXPOSE 80
