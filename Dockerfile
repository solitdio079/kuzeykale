# Use official PHP with Apache
FROM php:8.2-apache

# Enable Apache rewrite (if used)
RUN a2enmod rewrite

# Install common PHP extensions (add more if needed)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy project files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Set working directory
WORKDIR /var/www/html

# Expose default port
EXPOSE 80
