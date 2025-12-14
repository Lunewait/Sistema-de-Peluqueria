# Usar imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    libpq-dev \
    curl

# Limpiar caché para reducir tamaño de imagen
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP requeridas por Laravel
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# Habilitar mod_rewrite de Apache (Vital para rutas Laravel)
RUN a2enmod rewrite

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar archivos del proyecto
COPY . /var/www/html

# Configurar permisos para Apache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copiar configuración de Apache personalizada para apuntar a /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Instalar dependencias de PHP (Optimizado para prod)
RUN composer install --no-dev --optimize-autoloader

# Exponer el puerto 80 (Render usa esto por defecto)
EXPOSE 80

# Configurar el script de entrada
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Comando final
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
