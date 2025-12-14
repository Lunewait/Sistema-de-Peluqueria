#!/bin/bash

# Exit on fail
set -e

# Role: App Setup Automation

echo "🚀 Iniciando configuración de HairCloud (Modo Estricto)..."

# NOTA: Ya no creamos .env aquí. Confiaremos 100% en las variables de Render.

# 3. Optimizar Laravel para producción
echo "⚡ Optimizando caché..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Base de Datos (Esperar a que esté lista y migrar)
echo "📦 Ejecutando migraciones y seeds..."
php artisan migrate --force

echo "✅ Todo listo. Iniciando Apache..."

# 5. Iniciar Apache en primer plano
exec apache2-foreground
