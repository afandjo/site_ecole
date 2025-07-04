# Utilise l'image officielle PHP avec Apache
FROM php:8.2-apache

# Installe les dépendances système
RUN apt-get update && apt-get install -y \
    libzip-dev unzip zip curl git \
    && docker-php-ext-install pdo pdo_mysql zip

# Active mod_rewrite pour Laravel
RUN a2enmod rewrite

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copie les fichiers de l'application
COPY . /var/www/html

# Définit le répertoire de travail
WORKDIR /var/www/html

# Installe les dépendances PHP avec Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Donne les bonnes permissions à Laravel
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Configure Apache pour Laravel (redirige toutes les requêtes vers public/index.php)
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Expose le port 80
EXPOSE 80

# Lance Apache
CMD ["apache2-foreground"]
