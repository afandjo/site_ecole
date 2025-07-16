# Étape 1 : Choisir une image PHP avec les extensions nécessaires
FROM php:8.2-fpm

# Étape 2 : Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    mariadb-client \
    && docker-php-ext-install pdo_mysql zip

# Étape 3 : Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Étape 4 : Définir le répertoire de travail
WORKDIR /var/www

# Étape 5 : Copier le code source
COPY . .

# Étape 6 : Copier le fichier .env.example et créer .env si nécessaire
# COPY .env.example .env

# Étape 7 : Donner les permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Étape 8 : Installation des dépendances Laravel (sans migration)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan migrate --force
#    && php artisan migrate --force  ← supprimée temporairement

# Étape 9 : Exposer le port
EXPOSE 8000

# Étape 10 : Commande de démarrage
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
