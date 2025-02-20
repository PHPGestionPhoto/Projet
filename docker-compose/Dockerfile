FROM php:8.2-apache

# Mise à jour et installation des dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libfreetype6-dev \
    libyaml-dev \
    openssl \
#    nodejs \
#    npm \
    && docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-configure gd --with-freetype \
    && docker-php-ext-install gd \
    && pecl install yaml \
    && docker-php-ext-enable yaml \
    && apt-get clean && rm -rf /var/lib/apt/lists/*


# Modifier l'utilisateur www-data pour éviter des conflits de permission
RUN usermod -u 1000 www-data

# Activer les modules Apache nécessaires
RUN a2enmod rewrite ssl

# Supprimer le site SSL par défaut pour éviter les erreurs
RUN rm -f /etc/apache2/sites-enabled/default-ssl.conf

# Définir le répertoire de travail
WORKDIR /var/www/html

# Exposer les ports nécessaires
EXPOSE 80 443

# Démarrer Apache
CMD ["apache2-foreground"]