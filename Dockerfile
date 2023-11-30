# Use an official PHP image as the base image
FROM php:8.3-fpm

# Set the working directory in the container
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer and Laravel dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get install -y nodejs npm \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Download and install dockerize
RUN curl -o /usr/local/bin/dockerize -sSL https://github.com/jwilder/dockerize/releases/download/v0.6.1/dockerize-linux-amd64-v0.6.1 \
    && chmod +x /usr/local/bin/dockerize

# Install Laravel Mix globally (optional, for asset compilation)
RUN npm install -g laravel-mix

# Copy the Laravel application files into the container
COPY . .

RUN composer install

# Install npm dependencies
RUN npm install

# Make the entrypoint script executable
RUN chmod +x entrypoint.sh

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM with the entrypoint script
CMD ["./entrypoint.sh"]
