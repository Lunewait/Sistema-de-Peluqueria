# ✨ Lumina - Sistema Integral para Salones de Belleza

Plataforma premium de gestión de peluquería (SaaS) que combina una experiencia de usuario de lujo para los clientes con herramientas potentes de administración para el negocio.

![Lumina Banner](public/images/logo.png)

## 🌟 Nuevas Funcionalidades (v2.0)

### 🛍️ Experiencia del Cliente (Frontend One-Page)
*   **Tienda Integrada (Shop Drawer):** Catálogo de productos insertado orgánicamente en la landing page con carrito de compras lateral (sin recargas).
*   **Reserva de Citas Visual:** Flujo de 3 pasos (Servicio -> Estilista/Horario -> Pago) con validación de disponibilidad en tiempo real.
*   **Pasarela de Pagos Unificada:** 
    *   Tanto las **Reservas** como las **Compras** pasan por un checkout seguro centralizado.
    *   Soporte simulado para **Tarjetas de Crédito** (validación visual) y **Billeteras Digitales** (QR Yape/Plin).
*   **Imágenes Inteligentes:** Lógica de fallback avanzada que soporta imágenes locales y URLs externas (CDN).

### 💼 Gestión del Negocio (Admin & Stylist)
*   **Panel de Administrador:**
    *   Gestión total de citas (calendario y lista).
    *   **Punto de Venta (POS):** Cobro final de citas con cálculo automático de pendientes (Precio - Depósito).
    *   **Venta de Productos en Caja:** Posibilidad de agregar productos al momento de cobrar el servicio.
*   **Panel de Estilista:**
    *   Agenda personal diaria y semanal.
    *   Visualización de detalles de pago y notas del cliente.
*   **Gestión de Órdenes:** Sistema interno para manejar pedidos de la tienda online (`Pending`, `Paid`, `Shipped`).

## 🛠️ Stack Tecnológico

*   **Backend:** Laravel 10 (PHP 8.2)
*   **Base de Datos:** PostgreSQL / MySQL
*   **Frontend:** Blade Templates + **Alpine.js** (Reactividad ligera)
*   **Estilos:** Tailwind CSS (Diseño Premium "Lumina")
*   **Infraestructura:** Docker Ready + Render Deploy

## 🚀 Instalación y Despliegue

### Requisitos Previos
*   PHP 8.2+
*   Composer
*   Node.js & NPM (Opcional, los assets usan CDN)
*   Base de datos (PostgreSQL recomendado)

### 1. Instalación Local
```bash
git clone https://github.com/Lunewait/Sistema-de-Peluqueria.git
cd Sistema-de-Peluqueria
composer install
cp .env.example .env
php artisan key:generate
```

### 2. Configuración de Base de Datos
Configura tu `.env` y luego ejecuta:
```bash
# Migraciones + Seeders (Usuarios base y Productos con imágenes)
php artisan migrate:fresh --seed
```

### 3. Usuarios de Prueba (Seeders)
*   **Admin:** `admin@lumina.com` / `password`
*   **Estilista:** `ana@lumina.com` / `password`
*   **Cliente:** (Registro automático al reservar)

### 4. Ejecución
```bash
php artisan serve
```

## 💳 Flujo de Pagos (Payment Gateway)

El sistema cuenta con un controlador unificado `PaymentGatewayController` que maneja transacciones de dos tipos:
1.  **`booking`**: Cobra el depósito (20%) para confirmar una cita.
2.  **`order`**: Cobra el total de una compra en la tienda online.

La pasarela incluye simulaciones visuales de:
*   Procesamiento de Tarjetas (Loader y validación).
*   Generación de QRs para pago móvil.
*   Pantallas de éxito y redirección post-pago.

## 📦 Estructura de Base de Datos Clave
*   `users`: Roles (1: Admin, 2: Employee, 3: Client).
*   `appointments`: Citas con estados (`Pending`, `Confirmed`, `Completed`, `Cancelled`).
*   `products`: Catálogo con control de stock e imágenes (`image_url`).
*   `orders`: Pedidos de la tienda online con items en formato JSON.
*   `payments`: Registro histórico de transacciones.

---
© 2025 Lumina Salon Systems.
