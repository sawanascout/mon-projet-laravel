FROM php:8.2-cli

# Installer les dépendances nécessaires à PHP + wkhtmltopdf
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libonig-dev libpng-dev libjpeg-dev libfreetype6-dev \
    xfonts-75dpi xfonts-base fontconfig libxrender1 libjpeg62-turbo libssl1.1 libxext6 wget \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip gd mbstring \
    # Télécharger et installer wkhtmltopdf
    && wget https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.6-1/wkhtmltox_0.12.6-1.bionic_amd64.deb \
    && dpkg -i wkhtmltox_0.12.6-1.bionic_amd64.deb \
    && rm wkhtmltox_0.12.6-1.bionic_amd64.deb \
    && ln -s /usr/local/bin/wkhtmltopdf /usr/bin/wkhtmltopdf \
    && ln -s /usr/local/bin/wkhtmltoimage /usr/bin/wkhtmltoimage

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Répertoire de travail
WORKDIR /var/www/html

# Copier tous les fichiers du projet
COPY . .

# Installer les dépendances Laravel sans les dépendances de dev
RUN composer install --no-dev --optimize-autoloader

# Droits d’accès pour le cache et les fichiers temporaires
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exposer le port Laravel
EXPOSE 8000

# Commande de démarrage du conteneur
CMD ["sh", "-c", "php artisan storage:link && php artisan serve --host=0.0.0.0 --port=$PORT"]
