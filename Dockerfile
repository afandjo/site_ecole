# Étape 1 : Utiliser une image officielle PHP avec Apache
FROM php:8.2-apache

# Étape 2 : Installer les extensions PHP nécessaires pour Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev unzip zip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Étape 3 : Activer mod_rewrite (pour les routes Laravel)
RUN a2enmod rewrite

# Étape 4 : Copier le code source
COPY . /var/www/html

# Étape 5 : Définir le bon dossier de travail
WORKDIR /var/www/html

# Étape 6 : Fixer les permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Étape 7 : Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Étape 8 : Installer les dépendances Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Étape 9 : Copier un fichier .env si tu en as un prêt (optionnel)
# COPY .env.example .env

# Étape 10 : Générer la clé d'application Laravel
RUN php artisan key:generate

# Étape 11 : Exposer le port 80
EXPOSE 80
