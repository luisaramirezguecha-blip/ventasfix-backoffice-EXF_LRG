# VentasFix Backoffice

Sistema web (Backoffice) + API REST para la administración de **Usuarios**,
**Productos** y **Clientes** de la empresa ficticia VentasFix, con Dashboard
de estadísticas, autenticación vía sesión (web) y tokens Sanctum (API), y
documentación automática con Swagger / OpenAPI.

Proyecto desarrollado para la evaluación sumativa de **Desarrollo de Software
Web I** — Instituto Profesional San Sebastián.

---

## Stack tecnológico

| Herramienta | Versión |
|---|---|
| PHP | 8.5.7 |
| Laravel Framework | 13.31.0 |
| Composer | 2.10.2 |
| Base de datos | SQLite (por defecto) |
| Autenticación API | Laravel Sanctum |
| Documentación API | darkaonline/l5-swagger (zircote/swagger-php, atributos PHP 8) |

---

## Requisitos previos

Antes de levantar el proyecto, asegúrate de tener instalado:

- PHP >= 8.5 con las extensiones habituales de Laravel (`mbstring`, `pdo`,
  `pdo_sqlite`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`).
- Composer 2.x.
- Node.js y npm (para compilar los assets con Vite, si el proyecto usa CSS/JS
  del frontend).
- Git.

---

## Instrucciones para levantar el proyecto

1. **Clonar el repositorio**

   ```bash
   git clone https://github.com/luisaramirezguecha-blip/ventasfix-backoffice-EXF_LRG.git
   cd ventasfix-backoffice-EXF_LRG
   ```

2. **Instalar las dependencias de PHP**

   ```bash
   composer install
   ```

3. **Configurar el archivo de entorno**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Verifica en `.env` que la conexión a base de datos apunte a SQLite (o a
   la que corresponda):

   ```env
   DB_CONNECTION=sqlite
   ```

   Si usas SQLite y el archivo de base de datos no existe aún, créalo:

   ```bash
   touch database/database.sqlite
   ```

4. **Ejecutar las migraciones**

   ```bash
   php artisan migrate:fresh
   ```

   Esto crea las tablas de `users`, `productos`, `clientes` y
   `personal_access_tokens` (Sanctum).

5. **(Opcional) Sembrar datos de prueba**

   ```bash
   php artisan db:seed
   ```

6. **Instalar dependencias del frontend y compilar assets**

   ```bash
   npm install
   npm run build
   # o, para desarrollo con recarga en caliente:
   npm run dev
   ```

7. **Generar la documentación Swagger**

   ```bash
   php artisan l5-swagger:generate
   ```

   La especificación queda en `storage/api-docs/api-docs.json` y la UI
   interactiva queda disponible en `/api/documentation`.

8. **Levantar el servidor de desarrollo**

   ```bash
   php artisan serve
   ```

   Por defecto la aplicación queda disponible en `http://127.0.0.1:8000`.

9. **Probar el acceso**

   - Sistema web: `http://127.0.0.1:8000/login`
   - Dashboard: `http://127.0.0.1:8000/dashboard`
   - Documentación API (Swagger UI): `http://127.0.0.1:8000/api/documentation`
   - Login API: `POST http://127.0.0.1:8000/api/login`

   > **Nota:** el correo de los usuarios debe terminar obligatoriamente en
   > `@ventasfix.cl`, según lo exige la validación del sistema.

### Autenticación en Swagger UI

Al hacer login en `POST /api/login`, copia **solo el token** devuelto (sin la
palabra "Bearer" delante) y pégalo en el botón "Authorize" de Swagger UI —
la UI ya antepone la palabra `Bearer` automáticamente. Escribirla dos veces
provoca un error `401 Unauthorized` (ver Bug #3 en la bitácora de
desarrollo).

---

## Arquitectura del proyecto

```
app/Http/Controllers/
├── Controller.php          # controlador base + configuración global de Swagger (#[OA\Info])
├── AuthController.php      # login/logout web y API
├── ProductoController.php  # CRUD web de Productos
├── ClienteController.php   # CRUD web de Clientes
├── UsuarioController.php   # CRUD web de Usuarios
├── DashboardController.php # estadísticas del dashboard
└── Api/
    ├── ProductoApiController.php
    ├── ClienteApiController.php
    └── UsuarioApiController.php
```

Las rutas web (`routes/web.php`) y las rutas de la API (`routes/api.php`)
usan nombres separados con el prefijo `api.` (por ejemplo `api.usuarios.index`)
para evitar colisiones de nombres entre recursos equivalentes.

---

## Sistema de diseño: Atomic Design

El frontend del Backoffice sigue el patrón **Atomic Design**: piezas
pequeñas y genéricas ("átomos") se combinan en piezas intermedias
("moléculas"), y estas a su vez arman piezas grandes de página
("organismos"), todo envuelto por un layout base. Esto evita repetir HTML
entre las vistas de Productos, Clientes y Usuarios, y centraliza cualquier
cambio de estilo o comportamiento en un solo lugar.

```
resources/views/components/
├── atoms/
│   ├── input.blade.php        # <input> estilizado, genérico
│   └── button.blade.php       # botón con el estilo del tema
├── molecules/
│   └── field.blade.php        # label + input/textarea + mensaje de error
├── organisms/
│   └── page-frame.blade.php   # tarjeta oscura con marco decorativo
└── layouts/
    └── app.blade.php          # layout base: head, navegación, toggle de tema
```

### Jerarquía de los componentes

| Nivel | Componente | Responsabilidad |
|---|---|---|
| Átomo | `x-atoms.input` | Renderiza un `<input>` estilizado, sin lógica de validación |
| Átomo | `x-atoms.button` | Botón con el estilo dorado del tema |
| Molécula | `x-molecules.field` | Combina label + input/textarea + `@error` en un solo bloque reutilizable |
| Organismo | `x-organisms.page-frame` | Envuelve el contenido de cada página con la tarjeta oscura decorativa |
| Layout | `x-layouts.app` | Estructura HTML completa: `<head>`, navegación, toggle claro/oscuro |

### Ejemplo de uso

En lugar de escribir manualmente `<label>`, `<input>` y el bloque de error en
cada campo de cada formulario, se usa una sola línea por campo:

```blade
<x-layouts.app title="Nuevo Producto — VentasFix">
    <x-organisms.page-frame title="Nuevo Producto">
        <form action="{{ route('productos.store') }}" method="POST">
            @csrf
            <x-molecules.field label="SKU" name="sku" />
            <x-molecules.field label="Nombre" name="nombre" />
            <x-molecules.field label="Descripción larga" name="descripcion_larga" type="textarea" />
            <x-molecules.field label="Precio neto" name="precio_neto" type="number" step="0.01" />
            <x-atoms.button>Guardar</x-atoms.button>
        </form>
    </x-organisms.page-frame>
</x-layouts.app>
```

Si mañana cambia el diseño de los mensajes de error, basta con editar
`molecules/field.blade.php` una sola vez: el cambio se refleja
automáticamente en los formularios de Productos, Clientes y Usuarios.

---

## Entidades

| Entidad | Campos requeridos |
|---|---|
| Usuario | id, rut, nombre, apellido, email (`@ventasfix.cl`), password (cifrada) |
| Producto | id, sku, nombre, descripción corta, descripción larga, imagen, precio neto, precio de venta (neto + 19% IVA), stock actual, stock mínimo, stock bajo, stock alto |
| Cliente | id, rut empresa, rubro, razón social, teléfono, dirección, nombre contacto, email contacto |

---

## Seguridad

- Las contraseñas se cifran automáticamente mediante el cast
  `'password' => 'hashed'` en `App\Models\User`, tanto en creación como en
  actualización, sin necesidad de llamar a `Hash::make()` manualmente.
- Todas las rutas de escritura (crear/actualizar) exigen todos los campos
  obligatorios mediante `$request->validate()`.
- El consumo de la API requiere token Sanctum (`Authorization: Bearer
  <token>`) en todos los endpoints protegidos.

---

## Documentación de la API

La API expone operaciones CRUD para `productos`, `clientes` y `usuarios`,
todas protegidas con Sanctum y documentadas con atributos PHP 8
(`#[OA\...]`) en cada método de los controladores de `app/Http/Controllers/Api`.

| Método | Endpoint | Código de éxito |
|---|---|---|
| POST | `/api/login` | 200 |
| GET | `/api/{recurso}` | 200 |
| GET | `/api/{recurso}/{id}` | 200 |
| POST | `/api/{recurso}` | 201 |
| PUT | `/api/{recurso}/{id}` | 200 |
| DELETE | `/api/{recurso}/{id}` | 200 |

Donde `{recurso}` es `productos`, `clientes` o `usuarios`.

Explora todos los endpoints, sus esquemas y pruébalos directamente desde
`http://127.0.0.1:8000/api/documentation`.

---

## Licencia

Proyecto académico desarrollado como parte de la evaluación de Desarrollo de
Software Web I, Instituto Profesional San Sebastián.
