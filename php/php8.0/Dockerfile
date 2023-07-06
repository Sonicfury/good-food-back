# Utilisez l'image officielle PHP 8.0
FROM php:8.0-fpm

# Installer les dépendances de base et les extensions PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql pdo_pgsql zip

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.1.6

# Configurer le fichier de configuration PHP
#COPY php.ini /usr/local/etc/php/

# Exposer le port 9000 pour PHP-FPM
EXPOSE 9000

# Démarrer PHP-FPM lorsque le conteneur est lancé
CMD ["php-fpm"]
