# 💇‍♀️ Sistema de Gestión de Peluquería (HairCloud / Lumina)

Sistema integral de gestión para salones de belleza y estética, diseñado con una experiencia de usuario premium ("Lumina Design"). Incluye un flujo de reservas interactivo para clientes y un panel de control para estilistas.

![Lumina UI](public/images/logo.png)

## 🚀 Características Principales

### Para Clientes (Frontend)
*   **Diseño Premium (Lumina):** Interfaz moderna y elegante con animaciones suaves y paleta de colores Teal/Dark.
*   **Selección Visual de Servicios:** Tarjetas interactivas con imágenes de alta calidad.
*   **Agenda Dinámica:** Selección inteligente de fechas y horarios basada en disponibilidad real.
*   **Carrito de Productos:** Venta cruzada de productos (Sérums, Mascarillas) durante la reserva.
*   **Pagos Simulados:** Interfaz de pasarela de pagos con conversión de moneda (USD -> PEN) y cálculo de depósitos.
*   **Sistema de Notificaciones:** Pantallas de éxito.

### Para Estilistas (Backend)
*   **Dashboard Semanal:** Vista general de todas las citas de la semana.
*   **Agenda Diaria:** Lista detallada de citas del día con estados.

## 🛠 Stack Tecnológico

*   **Backend:** Laravel 10 (PHP 8.2)
*   **Base de Datos:** PostgreSQL
*   **Frontend:** Blade Templates + JavaScript Vanilla
*   **Estilos:** Tailwind CSS (vía CDN para máxima compatibilidad)
*   **Infraestructura:** Listo para desplegar en Render.com

## 💻 Instalación Local

1.  **Clonar el repositorio**
    ```bash
    git clone https://github.com/Lunewait/Sistema-de-Peluqueria.git
    cd Sistema-de-Peluqueria
    ```

2.  **Instalar Dependencias PHP**
    ```bash
    composer install
    ```

3.  **Configurar Entorno**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Configura tus credenciales de base de datos en el archivo `.env`.*

4.  **Base de Datos & Semillas**
    ```bash
    php artisan migrate --seed
    ```
    *Esto creará los usuarios de prueba (estilistas, administrador) y servicios base.*

5.  **Ejecutar Servidor**
    ```bash
    php artisan serve
    ```

## ☁️ Guía de Despliegue en Render.com

Este proyecto está optimizado para desplegarse como un **Web Service** en Render.

1.  **Crear Base de Datos (PostgreSQL):**
    *   En Render, crea una nueva "PostgreSQL database".
    *   Copia la `Internal Database URL`.

2.  **Crear Web Service:**
    *   Conecta tu repositorio de GitHub.
    *   **Runtime:** PHP
    *   **Build Command:** `composer install --no-dev --optimize-autoloader`
    *   **Start Command:** `heroku-php-apache2 public/`

3.  **Variables de Entorno (Environment Variables):**
    Añade las siguientes variables en la configuración de Render:
    *   `APP_NAME`: HairCloud
    *   `APP_ENV`: production
    *   `APP_KEY`: (Copia la clave generada en local)
    *   `APP_DEBUG`: false
    *   `APP_URL`: (Tu URL de Render, ej: https://mi-salon.onrender.com)
    *   `DATABASE_URL`: (Pega la URL interna de la base de datos que creaste en el paso 1)
    *   *Nota: Laravel detectará automáticamente la configuración desde `DATABASE_URL` si usas una configuración estándar de base de datos.*

4.  **Migración en Producción:**
    Una vez desplegado, entra a la "Shell" del servicio en Render y ejecuta:
    ```bash
    php artisan migrate --seed --force
    ```

## 📸 Capturas de Pantalla

*   **Paso 1: Selección de Servicios** - Diseño de tarjetas horizontales.
*   **Paso 3: Pago y Productos** - Resumen oscuro y venta de productos adicionales.

---
Desarrollado con ❤️ por **Antigravity** para **HairCloud Systems**.
