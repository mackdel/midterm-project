# Use an official PHP runtime as a parent image
FROM php:8.2-apache

# Install required system packages and dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Adding Postgres support:
RUN docker-php-ext-install pdo_pgsql

# Copy custom Apache configuration
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Enable utility to assists in managaing Apache modules
RUN a2enmod rewrite

# Suprisingly, I deployed to Render without this!
RUN echo "Listen 0.0.0.0:8080" >> /etc/apache2/apache2.conf

# Expose port 8080 to allow incoming connections to the container
EXPOSE 8080