#!/bin/bash

# Exit on fail
set -e

echo "🚀 Iniciando HairCloud..."

# NO cachear config - Laravel leerá las variables de entorno directamente
# Solo cachear rutas y vistas que no dependen de .env
php artisan route:cache
php artisan view:cache

# Ejecutar migraciones
echo "📦 Ejecutando migraciones..."
php artisan migrate --force

echo "✅ Listo. Iniciando servidor..."

# Iniciar Apache
exec apache2-foreground
