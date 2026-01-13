FROM php:7.2-apache

# ---- FIX DEBIAN EOL REPOS ----
RUN sed -i 's|deb.debian.org|archive.debian.org|g' /etc/apt/sources.list \
 && sed -i 's|security.debian.org|archive.debian.org|g' /etc/apt/sources.list \
 && echo 'Acquire::Check-Valid-Until "false";' > /etc/apt/apt.conf.d/99no-check-valid-until

# Enable Apache rewrite
RUN a2enmod rewrite

# Install dependencies
RUN apt-get update \
 && apt-get install -y curl \
 && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# ---- ionCube Loader (PHP 7.2 ONLY) ----
RUN set -eux; \
    EXT_DIR="$(php -r 'echo ini_get("extension_dir");')"; \
    curl -fsSL https://downloads.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz -o /tmp/ioncube.tar.gz; \
    tar -xzf /tmp/ioncube.tar.gz -C /tmp; \
    cp /tmp/ioncube/ioncube_loader_lin_7.2.so "$EXT_DIR/"; \
    echo "zend_extension=$EXT_DIR/ioncube_loader_lin_7.2.so" > /usr/local/etc/php/conf.d/00-ioncube.ini; \
    rm -rf /tmp/ioncube /tmp/ioncube.tar.gz

# Copy app
COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html
EXPOSE 80
