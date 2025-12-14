#!/bin/bash
set -e

echo "🚀 Iniciando Apache..."

# Iniciar Apache en segundo plano
apache2-ctl start

# Esperar a que Apache esté listo
sleep 2

# AHORA sí ejecutar migraciones (cuando todas las variables ya están cargadas)
echo "📦 Ejecutando migraciones..."
php artisan migrate --force || echo "⚠️  Migraciones fallaron, pero continuando..."

echo "✅ Sistema listo"

# Mantener Apache corriendo en primer plano
tail -f /var/log/apache2/error.log
