# 1. Choisir une image PHP avec Apache
FROM php:8.2-apache

# 2. Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    git curl zip unzip libonig-dev libzip-dev libpng-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring gd

# 3. Activer mod_rewrite d’Apache
RUN a2enmod rewrite

# 4. Copier les fichiers du projet dans le conteneur
COPY . /var/www/html

# 5. Changer le répertoire de travail
WORKDIR /var/www/html

# 6. Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Installer les dépendances Laravel
RUN composer install --no-interaction --optimize-autoloader

# 8. Donner les bons droits aux fichiers
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# 9. Exposer le port 80
EXPOSE 80
