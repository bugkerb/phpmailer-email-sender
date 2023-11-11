# Use the official PHP image
FROM php:7.4-apache

# Install necessary extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli zip

# Enable Apache modules
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy the PHP files into the container
COPY src/ /var/www/html/

# Install Composer for PHPMailer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHPMailer dependencies
RUN composer require phpmailer/phpmailer

# Expose the Apache port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
