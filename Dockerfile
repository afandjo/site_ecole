# Étape 1 : Base image
FROM php:8.2-apache

# Étape 2 : Installation des extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev zip \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Étape 3 : Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Étape 4 : Copie de l'application dans le conteneur
COPY . /var/www/html

# Étape 5 : Configuration des droits
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Étape 6 : Activation du module Apache rewrite
RUN a2enmod rewrite

# Étape 7 : Définir le dossier de travail
WORKDIR /var/www/html

# Étape 8 : Installation des dépendances Laravel et migration automatique
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan key:generate \
    && php artisan migrate --force
RUN php artisan config:clear && php artisan config:cache


# Étape 9 : Lancer Apache en mode foreground
CMD ["apache2-foreground"]
