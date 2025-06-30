# Utilise PHP avec Apache
FROM php:8.2-apache

# Installer les dépendances PHP
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip curl git \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Active le module rewrite d’Apache
RUN a2enmod rewrite

# Copie les fichiers Laravel dans le conteneur
COPY . /var/www/html

# Définit le répertoire de travail
WORKDIR /var/www/html

# Fixe le bon dossier racine Apache : public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Ajoute la configuration pour autoriser .htaccess dans /public
RUN echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installe les dépendances Laravel
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Ouvre le port 80
EXPOSE 80

# Lance Apache
CMD ["apache2-foreground"]
