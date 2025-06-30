FROM php:8.2-apache

# Install extensions nécessaires pour Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Activer mod_rewrite pour Apache
RUN a2enmod rewrite

# Copier les fichiers dans le conteneur
COPY . /var/www/html

# Définir le dossier comme root
WORKDIR /var/www/html

# Changer les permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Modifier les configs Apache pour pointer vers public/
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Copier le .env si nécessaire (sinon géré par Render)

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installer les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Générer la clé d’application
RUN php artisan config:clear && php artisan key:generate
