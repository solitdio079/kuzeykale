FROM php:8.1-apache

# Enable Apache modules
RUN a2enmod rewrite

# Install dependencies
RUN apt-get update && apt-get install -y curl \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# ----------------------------
# Install ionCube Loader (HARD FIX)
# ----------------------------
RUN set -eux; \
    PHP_EXT_DIR="$(php -r 'echo ini_get("extension_dir");')"; \
    PHP_VERSION="$(php -r 'echo PHP_MAJOR_VERSION.".".PHP_MINOR_VERSION;')"; \
    echo "PHP EXT DIR: $PHP_EXT_DIR"; \
    echo "PHP VERSION: $PHP_VERSION"; \
    curl -fsSL https://downloads.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz -o /tmp/ioncube.tar.gz; \
    tar -xzf /tmp/ioncube.tar.gz -C /tmp; \
    cp "/tmp/ioncube/ioncube_loader_lin_${PHP_VERSION}.so" "$PHP_EXT_DIR/"; \
    echo "zend_extension=${PHP_EXT_DIR}/ioncube_loader_lin_${PHP_VERSION}.so" > /usr/local/etc/php/conf.d/00-ioncube.ini; \
    php -m | grep -i ioncube || true; \
    rm -rf /tmp/ioncube /tmp/ioncube.tar.gz

# Copy application
COPY . /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html
EXPOSE 80
