# Use base image php:8.0-apache
FROM php:8.0-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY /app /var/www/html/

RUN a2enmod rewrite

RUN chown -R www-data:www-data /var/www/html



# # Use base image Alpine
# FROM alpine:latest

# # Update packages and install dependencies
# RUN apk update && \
#     apk add --no-cache \
#         openssl \
#         openssl-dev \
#         php \
#         php-openssl \
#         php-cli \
#         php-json \
#         php-pdo \
#         php-pdo_mysql \
#         curl \
#         bash 


# # Copy application files
# COPY app /var/www/html

# # Expose port 80 (default for HTTP server)
# EXPOSE 80

# # Start PHP server
# CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www/html"]
