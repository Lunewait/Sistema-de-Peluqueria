# Documentación Integral del Sistema Lumina (HairCloud)

**Resumen Ejecutivo:**
Lumina es una plataforma integral de gestión (SaaS) diseñada para optimizar las operaciones de salones de belleza y estética. El sistema centraliza la experiencia del cliente (reservas visuales y tienda online) con la gestión operativa del negocio (agenda de estilistas, control de caja y administración de inventario), proporcionando una solución tecnológica robusta y escalable.

---

## 1. ⚙️ Documentación de Requisitos

### Resumen de Propósito
El sistema resuelve la desconexión entre la captación de clientes y la gestión operativa en los salones de belleza. Elimina el uso de agendas en papel, reduce el ausentismo mediante depósitos online y abre un nuevo canal de ventas (e-commerce) integrado en la misma plataforma.

### Requisitos Funcionales Clave
*   **Reserva Visual de Citas:** Flujo interactivo de 3 pasos (Servicio -> Estilista/Horario -> Pago) con validación de disponibilidad en tiempo real.
*   **Tienda Online Integrada:** Catálogo de productos y carrito de compras (Drawer) insertado en la página principal, permitiendo la venta de productos sin interrumpir la navegación.
*   **Pasarela de Pagos Unificada:** Sistema centralizado que procesa tanto los depósitos de reservas (20%) como el pago total de productos, simulando transacciones con Tarjeta y QR (Yape/Plin).
*   **Panel de Administración (POS):** Módulo para que el administrador gestione la agenda global, finalice citas y procese cobros en caja, calculando automáticamente los montos pendientes.
*   **Gestión de Estilistas:** Dashboard personal para que cada profesional visualice su agenda diaria y semanal.
*   **Gestión de Inventario:** Control de stock automático que descuenta unidades al confirmar compras online o ventas en el local.
*   **Sistema de Roles y Permisos:** Acceso diferenciado para Administradores, Estilistas y Clientes, protegidos por middleware de seguridad.

### Requisitos No Funcionales
*   **Rendimiento:** La carga inicial de la Landing Page debe ser inferior a 2 segundos (optimizada con TailwindCSS y Alpine.js).
*   **Usabilidad (UX Premium):** Interfaz diseñada bajo el concepto "Lumina Design" (uso de espacios, gradientes Teal/Slate y micro-interacciones) para transmitir lujo y confianza.
*   **Seguridad:** Protección CSRF en todos los formularios, sanitización de entradas y gestión de sesiones segura.
*   **Escalabilidad:** Arquitectura preparada para despliegue en contenedores (Docker) y servicios PaaS (Render).
*   **Compatibilidad:** Diseño totalmente responsivo (Mobile-First) adaptable a tablets y dispositivos de escritorio.

---

## 2. 🏛️ Documentación de Arquitectura y Diseño

### Modelo de Arquitectura
El sistema sigue una arquitectura **Monolítica Modular** basada en el patrón **MVC (Modelo-Vista-Controlador)** proporcionado por el framework Laravel.
*   **Ventaja:** Simplifica el desarrollo y despliegue al mantener la lógica de negocio, la capa de datos y la interfaz en un solo repositorio cohesivo.
*   **Frontend:** Renderizado desde el servidor (SSR) usando Blade Templates, enriquecido con Alpine.js para interactividad del lado del cliente sin la complejidad de una SPA completa.

### Diagrama de Componentes (Descripción Textual)
1.  **Frontend UI (Blade + Alpine):** Capa de presentación. Gestiona la interacción del usuario (carrito, modales, formularios). Se comunica con el Backend a través de peticiones HTTP estándar y llamadas AJAX (Fetch API) para operaciones dinámicas.
2.  **Backend (Laravel App):** Núcleo lógico.
    *   **Router:** Despacha las peticiones a los controladores adecuados.
    *   **Controllers:** Contiene la lógica de negocio (`BookingController`, `ShopController`, `PaymentGatewayController`).
    *   **Middleware:** Gestiona la autenticación y roles (`IsAdmin`, `IsStylist`).
3.  **Base de Datos (PostgreSQL):** Almacenamiento relacional persistente para Usuarios, Citas, Productos, Órdenes y Pagos.
4.  **Sistema de Archivos (Storage):** Almacenamiento de imágenes de productos y assets estáticos.

### Tecnologías Utilizadas

| Componente | Tecnología | Versión Clave | Descripción |
|---|---|---|---|
| Backend Framework | **Laravel** | 10.x (PHP 8.2) | Framework robusto para lógica y API. |
| Base de Datos | **PostgreSQL** | 14+ | Motor de BD relacional fiable. |
| Frontend Templates | **Blade** | - | Motor de plantillas nativo de Laravel. |
| Frontend Intercativo| **Alpine.js** | 3.x | Reactividad ligera para modales y carrito. |
| Estilos CSS | **Tailwind CSS** | 3.x | Framework utility-first para diseño UI. |
| Infraestructura | **Docker** (Opcional) | - | Contenerización para entorno local. |
| Despliegue | **Render** | - | Plataforma PaaS para producción. |

---

## 3. 🧑‍💻 Documentación Técnica (Desarrolladores)

### Guía de Instalación del Entorno Local

1.  **Clonar el Repositorio:**
    ```bash
    git clone https://github.com/Lunewait/Sistema-de-Peluqueria.git
    cd Sistema-de-Peluqueria
    ```

2.  **Instalar Dependencias:**
    Asegúrate de tener PHP 8.2+ y Composer instalados.
    ```bash
    composer install
    ```

3.  **Configurar Variables de Entorno:**
    Duplica el archivo de ejemplo y genera la clave de aplicación.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Edita `.env` para configurar tu conexión a base de datos local (DB_DATABASE, DB_USERNAME, etc.).*

4.  **Migración y Datos de Prueba (Seeders):**
    Este comando crea las tablas e inserta productos, usuarios y datos iniciales.
    ```bash
    php artisan migrate:fresh --seed
    ```

5.  **Iniciar Servidor de Desarrollo:**
    ```bash
    php artisan serve
    ```
    Accede a `http://localhost:8000`.

### Estructura de Directorios Simplificada

*   `/app`
    *   `/Http/Controllers`: Lógica de negocio (Admin, Shop, Booking).
    *   `/Models`: Representación de datos (User, Appointment, Product, Order).
*   `/database`
    *   `/migrations`: Definiciones de esquema de BD.
    *   `/seeders`: Datos iniciales de prueba.
*   `/resources`
    *   `/views`: Plantillas Blade (HTML).
        *   `/admin`: Vistas del panel administrativo.
        *   `/shop`: Componentes de la tienda.
        *   `/booking`: Pasos del flujo de reserva.
*   `/routes`: Definición de rutas web (`web.php`) y API.
*   `/public`: Assets públicos (imágenes, css compilado).

### Convenciones de Codificación
*   **Controladores:** `PascalCase` (Ej: `BookingController`). Métodos RESTful estándar (`index`, `store`, `show`, `update`).
*   **Modelos:** Singular, `PascalCase` (Ej: `Appointment`). Mapean a tablas en plural (`appointments`).
*   **Vistas:** `kebab-case` anidadas por módulo (Ej: `resources/views/admin/appointments/index.blade.php`).
*   **Variables:** `camelCase` para variables PHP y JS. `snake_case` para columnas de base de datos.
*   **Idioma:** El código y comentarios técnicos están en Inglés. Los textos visibles al usuario están en Español.

---

## 4. 🗃️ Documentación de Operaciones

### Guía de Despliegue (Producción en Render)

1.  **Base de Datos:** Crear una instancia de PostgreSQL en Render y copiar la `Internal Database URL`.
2.  **Servicio Web:** Crear un nuevo Web Service conectado al repositorio GitHub.
    *   **Entorno:** PHP.
    *   **Build Command:** `composer install --no-dev --optimize-autoloader`.
    *   **Start Command:** `heroku-php-apache2 public/`.
3.  **Variables de Entorno:** Configurar `APP_ENV=production`, `APP_DEBUG=false`, `APP_KEY` y `DATABASE_URL` en el dashboard de Render.
4.  **Migración:** Ejecutar las migraciones desde la Shell de Render tras el primer despliegue:
    ```bash
    php artisan migrate --force --seed
    ```

### Monitoreo y Logs
*   **Logs de Aplicación:** Laravel guarda logs en `storage/logs/laravel.log`. En producción, estos se redirigen a `stdout` y pueden visualizarse en el panel de Logs de Render o AWS CloudWatch.
*   **Métricas Clave:**
    *   Tasa de errores 500 (Server Errors).
    *   Tiempo de respuesta promedio.
    *   Uso de memoria del contenedor PHP.

### Procedimientos de Back-up
*   **Base de Datos:** Render realiza backups automáticos diarios (en planes pagados).
*   **Manual:** Utilizar `pg_dump` para extraer una copia local:
    ```bash
    pg_dump "postgres://user:pass@host/dbname" > backup_lumina_$(date +%F).sql
    ```
*   **Restauración:** Utilizar `psql` o `pg_restore` para recuperar datos desde un archivo SQL.

---
*Documentación generada automáticamente para el sistema Lumina v2.0*
