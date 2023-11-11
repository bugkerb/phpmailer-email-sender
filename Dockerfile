FROM composer as builder
# Set the working directory
WORKDIR /app
# Install PHPMailer dependencies
RUN composer require phpmailer/phpmailer

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
# Copy vendor form builder
COPY --from=builder /app/vendor /var/www/vendor

# Expose the Apache port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
