#!/bin/bash

# Exit on fail
set -e

# Role: App Setup Automation

echo "🚀 Iniciando configuración de HairCloud..."

# 1. Configurar entorno si no existe en producción
if [ ! -f .env ]; then
    echo "📝 Creando .env desde ejemplo..."
    cp .env.example .env
fi

# 2. Generar key si falta (solo si APP_KEY está vacía)
if grep -q "APP_KEY=" .env && [ -z "$(grep "APP_KEY=" .env | cut -d '=' -f2)" ]; then
    echo "🔑 Generando App Key..."
    php artisan key:generate
fi

# 3. Optimizar Laravel para producción
echo "⚡ Optimizando caché..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Base de Datos (Esperar a que esté lista y migrar)
echo "📦 Ejecutando migraciones y seeds..."
# El --force es necesario en producción
php artisan migrate --force
# Ejecutar seeds solo si es necesario (puedes comentar esto si no quieres resetear datos siempre, 
# pero para el primer despliegue es útil. O usa una lógica idempotente)
# php artisan db:seed --force 

echo "✅ Todo listo. Iniciando Apache..."

# 5. Iniciar Apache en primer plano
exec apache2-foreground
