FROM php:8.2-apache

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    zip unzip git curl libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip

# Activer mod_rewrite
RUN a2enmod rewrite

# Copier les fichiers Laravel dans le bon dossier
COPY . /var/www/html

# Définir les permissions correctes
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Changer le répertoire de travail
WORKDIR /var/www/html

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installer les dépendances PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Activer index.php par défaut
RUN sed -i 's|DirectoryIndex .*|DirectoryIndex index.php|g' /etc/apache2/apache2.conf

# Configurer Apache pour Laravel
RUN echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf && \
    a2enconf laravel

# Exposer le port 80
EXPOSE 80

# Commande de démarrage
CMD ["apache2-foreground"]
