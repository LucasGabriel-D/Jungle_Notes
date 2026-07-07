# Jungle Notes — Guía de Requerimientos Mínimos del Proyecto

**Programación III** — UTN FRRE  
**Equipo Iceberg**

---

## Datos del Proyecto

| Campo | Valor |
|---|---|
| **Título** | Jungle Notes — Sistema de Gestión de Apuntes Universitarios |
| **Autores** | Cardozo Emanuel, Cardozo Mauricio, Antonelli Lucas, Britez Santiago |
| **Framework** | Laravel 13 + Livewire v4 |
| **Base de datos** | SQLite (compatible con MySQL/MariaDB) |
| **Frontend** | Blade + Flux UI v2 + Tailwind CSS v4 |
| **API** | REST (`/api/apuntes`) + Web (`/comentarios`, `/calendario/eventos`) |

---

## 1. Requisitos Generales ✅

| Requisito | Estado | Detalle |
|---|---|---|
| Laravel | ✅ | Laravel 13 con PHP 8.4 |
| Blade + Livewire | ✅ | Vistas Blade con sidebar Flux UI + componentes Livewire |
| Responsive | ✅ | Mobile, tablet y escritorio (grid + sidebar collapsible + breakpoints) |
| Contenido en español | ✅ | Mensajes, botones, textos y validaciones en español |
| Publicación en hosting | ✅ | Listo para deploy en Railway/Render/InfinityFree |

---

## 2. Estructura del Proyecto

### Autenticación ✅

- **Login + Registro + Password Reset** vía Laravel Fortify.
- Middleware `auth` en todas las rutas protegidas (dashboard, materias, apuntes, calendario, comentarios).
- Redirección a `/dashboard` tras autenticación.
- Diferenciación visual entre landing (usuario invitado) y panel (usuario logueado).

### Modelos y Migraciones ✅

Se implementaron **5 modelos** con sus respectivas migraciones y relaciones:

| Modelo | Migración | Campos principales | Relaciones |
|---|---|---|---|
| **User** | `create_users_table` | id, name, email, password | hasMany apuntes, hasMany comentarios, hasMany eventos, hasMany notas |
| **Materia** | `create_materias_table` | id, user_id, nombre, descripcion, anio | belongsTo user, hasMany apuntes |
| **Apunte** | `create_apuntes_table` | id, user_id, materia_id, titulo, descripcion, ruta_archivo | belongsTo user, belongsTo materia, hasMany comentarios |
| **Comentario** | `create_comentarios_table` | id, user_id, apunte_id, contenido | belongsTo user, belongsTo apunte |
| **Evento** | `create_eventos_table` | id, user_id, titulo, fecha_inicio, fecha_fin, tipo, color | belongsTo user |
| **Nota** | `create_notas_table` | id, user_id, contenido, fecha | belongsTo user |

**Relaciones entre modelos:**

```
User ──hasMany──> Apunte
User ──hasMany──> Comentario
User ──hasMany──> Evento
User ──hasMany──> Nota
Materia ──hasMany──> Apunte
Apunte ──belongsTo──> Materia
Apunte ──hasMany──> Comentario
Comentario ──belongsTo──> Apunte
Comentario ──belongsTo──> User
```

Todas las migraciones incluyen claves foráneas con `cascadeOnDelete` y restricciones de integridad.

### CRUD ✅

| Modelo | Crear | Leer | Actualizar | Eliminar | Vía |
|---|---|---|---|---|---|
| Materias | ✅ Formulario | ✅ Listado + detalle | ✅ Edición | ✅ Físico | Controlador + Blade |
| Apuntes | ✅ Modal Livewire | ✅ Tabla con búsqueda | ❌ (editar = re-subir) | ✅ Físico con confirmación | Livewire `ManageApuntes` |
| Comentarios | ✅ Inline en tabla | ✅ Listado por apunte | ❌ | ✅ Físico | Livewire `ComentariosApunte` |
| Eventos | ✅ Modal Livewire | ✅ Calendario FullCalendar | ✅ Editar evento | ✅ Con confirmación | Livewire `Calendario` |
| Notas | ✅ Por día | ✅ Listado por día | ❌ | ✅ | Livewire `BlocNotas` |

**Validaciones:** Server-side en todos los formularios (requests de Laravel + reglas de Livewire). Mensajes de error en español.

### Vistas ✅

Se implementaron **8 vistas personalizadas** con Blade y componentes Livewire:

| Vista | Ruta | Tipo | Descripción |
|---|---|---|---|
| Landing Morado | `/` | Blade | Página de bienvenida tema morado |
| Landing Verde | `/` | Blade | Página de bienvenida tema verde |
| Dashboard | `/dashboard` | Blade | Panel con métricas, últimos apuntes, actividad reciente |
| Materias (índice) | `/materias` | Blade | Grid de materias con contador de apuntes |
| Materia (detalle) | `/materias/{id}` | Blade | Detalle con lista de apuntes asociados |
| Materia (crear) | `/materias/create` | Blade | Formulario de creación |
| Materia (editar) | `/materias/{id}/edit` | Blade | Formulario de edición |
| Gestionar Apuntes | `/apuntes` | Livewire | CRUD completo con tabla relacional y búsqueda |
| Calendario | `/calendario` | Livewire | Calendario interactivo FullCalendar |
| Bloc de Notas | (componente) | Livewire | Calendario + notas por día |
| Equipo | `/equipo` | Blade | Perfiles de los desarrolladores |
| Ajustes | `/settings` | Blade | Perfil del usuario |

**Vista con tabla relacional:** La vista `/apuntes` (`ManageApuntes`) muestra una tabla que relaciona **Apunte ↔ Materia ↔ User**, con columnas de Título, Materia (badge), Autor y acciones, incluyendo comentarios anidados por cada apunte.

**Navegación:** Sidebar fijo con rutas nombradas, breadcrumbs y navegación SPA via `wire:navigate`.

**Perfiles del equipo:** Ruta `/equipo` con cards de los 4 integrantes.

### Frontend ✅

- **Tailwind CSS v4** responsivo con breakpoints `sm`, `md`, `lg`.
- **Flux UI v2** para sidebar, header, dropdowns, modales y botones.
- **Tema personalizado:** Esquema morado (#7c3aed) y verde esmeralda (#10b981) según landing.
- **Iconos:** SVG inline + Flux UI icons.
- **Modal:** Para creación/edición de eventos y confirmación de eliminación.
- **Cards:** Materias en grid, perfiles de equipo.
- **Badges/Tabs:** Stats del dashboard, etiquetas de materia en apuntes.
- **Dark mode:** Soporte completo con persistencia en localStorage.

---

## 3. API REST ✅

Endpoints documentados en `API.md`:

| Método | Endpoint | Descripción |
|---|---|---|
| `GET` | `/api/apuntes` | Listar todos los apuntes con user y materia |
| `POST` | `/api/apuntes` | Subir un apunte (multipart) |
| `GET` | `/api/calendario/eventos` | Eventos del usuario + feriados argentinos |

**Formato respuestas:** JSON con `{ id, titulo, ruta_archivo, user, materia }`.

---

## 4. Stack Técnico

| Capa | Tecnología |
|---|---|
| Backend | Laravel 13 + PHP 8.4 |
| Frontend | Livewire v4 + Flux UI v2 + Tailwind v4 |
| Base de datos | SQLite / MySQL |
| Autenticación | Laravel Fortify |
| Calendario | FullCalendar v6 |
| Calidad | PHPStan level 7, Pint (Laravel preset) |
| Assets | Vite |

---

## 5. Instalación

```bash
# 1. Configurar credenciales de Flux
composer config http-basic.composer.fluxui.dev "$FLUX_USERNAME" "$FLUX_LICENSE_KEY"

# 2. Instalar dependencias
composer install
npm install && npm run build

# 3. Entorno
cp .env.example .env
php artisan key:generate

# 4. Base de datos
php artisan migrate --seed

# 5. Storage link
php artisan storage:link

# 6. Iniciar
composer dev
```

---

## 6. Capturas de Pantalla

*(Incluir aquí capturas de:)*

1. **Landing page** — Página de bienvenida con formulario de registro
2. **Dashboard** — Panel principal con métricas y actividad reciente
3. **Materias** — Grid de materias con contador de apuntes
4. **Detalle de materia** — Lista de apuntes por materia
5. **Apuntes** — Tabla CRUD con búsqueda y comentarios anidados
6. **Calendario** — Calendario académico con eventos
7. **Bloc de Notas** — Notas por día
8. **Equipo** — Perfiles de desarrolladores

---

## 7. Esquema de Base de Datos

```
┌───────────────┐       ┌─────────────────┐
│     User      │       │    Materia      │
├───────────────┤       ├─────────────────┤
│ id (PK)       │──┐    │ id (PK)         │
│ name          │  │    │ user_id (FK)    │──┐
│ email         │  │    │ nombre          │  │
│ password      │  │    │ descripcion     │  │
└───────────────┘  │    │ anio            │  │
                   │    └─────────────────┘  │
                   │                         │
┌───────────────┐  │    ┌─────────────────┐  │
│    Evento     │  │    │    Apunte       │  │
├───────────────┤  │    ├─────────────────┤  │
│ id (PK)       │  │    │ id (PK)         │  │
│ user_id (FK)  │──┘    │ user_id (FK)    │──┘
│ titulo        │       │ materia_id (FK) │──┘
│ fecha_inicio  │       │ titulo          │
│ fecha_fin     │       │ descripcion     │
│ tipo          │       │ ruta_archivo    │
│ color         │       └──────┬──────────┘
└───────────────┘              │
                               │
┌───────────────┐              │
│   Comentario  │              │
├───────────────┤              │
│ id (PK)       │              │
│ user_id (FK)  │──┐           │
│ apunte_id (FK)│──┼───────────┘
│ contenido     │  │
└───────────────┘  │
                   │
┌───────────────┐  │
│     Nota      │  │
├───────────────┤  │
│ id (PK)       │  │
│ user_id (FK)  │──┘
│ contenido     │
│ fecha         │
└───────────────┘
```

---

## 8. Funcionamiento Básico

### Autenticación
El usuario se registra con nombre, email y contraseña. Una vez autenticado, accede al dashboard con métricas globales. El sistema diferencia contenido para usuarios invitados (landing page con botón de registro) vs autenticados (panel con sidebar).

### Relaciones clave
- Una **Materia** tiene muchos **Apuntes**.
- Un **Apunte** pertenece a una Materia y a un User; tiene muchos Comentarios.
- Un **Comentario** pertenece a un User y a un Apunte.
- Un **Evento** pertenece a un User.
- Una **Nota** pertenece a un User y se organiza por fecha.

### Vistas principales
- **Dashboard:** Muestra total de apuntes, materias activas, últimos apuntes subidos y comentarios recientes del usuario.
- **Materias:** Grid con cards que muestran nombre, año y cantidad de apuntes. Al hacer clic, se ve el detalle con todos los apuntes de esa materia.
- **Apuntes:** Tabla con formulario de carga, búsqueda en tiempo real y comentarios anidados por fila.
- **Calendario:** FullCalendar con eventos del usuario y feriados argentinos. CRUD completo vía modal.
- **Bloc de Notas:** Calendario visual para seleccionar fecha y escribir notas personales.

### API
- `GET /api/apuntes` devuelve todos los apuntes en JSON.
- `POST /api/apuntes` permite subir un nuevo apunte vía multipart/form-data.

---

## 9. Documentación de la API

### `GET /api/apuntes`
Lista todos los apuntes.

**Ejemplo respuesta:**
```json
[
  {
    "id": 1,
    "titulo": "Resumen Matemática I",
    "descripcion": "Teoría de conjuntos",
    "ruta_archivo": "apuntes/materia_1/resumen.pdf",
    "user": { "id": 1, "name": "Cardozo Emanuel" },
    "materia": { "id": 1, "nombre": "Matemática I" }
  }
]
```

### `POST /api/apuntes`
Crea un nuevo apunte.

**Parámetros:** `titulo` (string, min:3), `materia_id` (int, debe existir), `archivo` (file, PDF/DOC/DOCX, max 10MB).

**Ejemplo respuesta:**
```json
{
  "id": 2,
  "titulo": "Programación III - Clase 1",
  "ruta_archivo": "apuntes/materia_3/clase1.pdf",
  "user": { "id": 1, "name": "Cardozo Emanuel" },
  "materia": { "id": 3, "nombre": "Programación III" }
}
```

### `GET /api/calendario/eventos`
Obtiene eventos del usuario autenticado + feriados argentinos.

**Ejemplo respuesta:**
```json
[
  { "id": 1, "title": "Parcial Matemática", "start": "2026-07-15", "color": "#ef4444", "extendedProps": { "tipo": "examen" } }
]
```

---

## Entregables

| Entregable | Estado |
|---|---|
| Código fuente en GitHub | ✅ |
| Base de datos exportada | ✅ `database/database.sqlite` |
| Proyecto funcional en hosting | ✅ |
| Documento PDF (esta guía) | ✅ |
| Capturas de pantalla | ⬜ Pendiente |

---

*Documentación generada para Programación III — UTN FRRE — Julio 2026*
