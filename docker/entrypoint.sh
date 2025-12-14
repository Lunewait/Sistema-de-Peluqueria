#!/bin/bash
set -e

echo "🚀 Iniciando HairCloud..."

# 1. Caché de rutas y vistas (Mejora velocidad)
php artisan route:cache
php artisan view:cache

# 2. Ejecutar migraciones
# Esto ahora funcionará porque ya pusiste DB_HOST en Render
echo "📦 Ejecutando migraciones..."
php artisan migrate --force

echo "✅ Todo listo. Arrancando Apache..."

# 3. Iniciar Apache (Comando oficial de la imagen Docker)
exec apache2-foreground
