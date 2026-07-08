# JungleNotes — Documentación de la API

## API REST (prefix `/api`)

### Apuntes

**`GET /api/apuntes`** — Listar todos los apuntes
```
→ Sin parámetros
← 200: [{ id, titulo, descripcion, ruta_archivo, user, materia }]
```

**`POST /api/apuntes`** — Subir un apunte
```
→ multipart/form-data
   titulo: string (min:3)
   materia_id: int (debe existir)
   archivo: file (pdf,doc,docx, max 10MB)
← 201: { id, titulo, ruta_archivo, user, materia }
```

---

## API Web (prefix `/`, con sesión)

Todas requieren autenticación vía sesión (middleware `auth`).

### Dashboard

**`GET /dashboard`** — Panel principal del usuario
```
→ Sin parámetros
← 200: Vista con apuntes recientes, materias, últimos comentarios
```

### Materias

| Método | Ruta | Acción |
|--------|------|--------|
| `GET` | `/materias` | Listar materias |
| `GET` | `/materias/create` | Formulario de creación |
| `POST` | `/materias` | Crear (`nombre`, `descripcion?`, `anio:1-5`) |
| `GET` | `/materias/{id}` | Ver materia con sus apuntes |
| `GET` | `/materias/{id}/edit` | Formulario de edición |
| `PUT` | `/materias/{id}` | Actualizar |
| `DELETE` | `/materias/{id}` | Eliminar |

### Apuntes (Livewire)

**`GET /apuntes`** — CRUD completo via Livewire
```
Renderizado en tiempo real con búsqueda, carga de archivos y modal de creación.
```

### Comentarios

| Método | Ruta | Acción |
|--------|------|--------|
| `GET` | `/comentarios` | Listar todos |
| `POST` | `/comentarios` | Crear (`apunte_id`, `contenido:3-500 chars`) |
| `GET` | `/comentarios/{id}` | Ver uno |
| `DELETE` | `/comentarios/{id}` | Eliminar |

### Calendario

**`GET /calendario`** — Calendario académico (FullCalendar + Livewire)
```
Renderiza eventos del usuario + feriados nacionales argentinos.
CRUD de eventos vía modal Livewire (crear, editar, eliminar).
Incluye locale ES con botones en español (Hoy, Mes, Semana, Día).
Ajuste automático de altura (contentHeight: 'auto', aspectRatio: 1.8).
Compatibilidad con navegación SPA (wire:navigate).
```

**`GET /api/calendario/eventos`** — Eventos en JSON para FullCalendar
```
← 200: [{ id, title, start, end, color, extendedProps: { tipo } }]
Eventos de usuario + feriados configurados en config/feriados.php
```

---

## Modelos (Schema)

| Modelo | Campos | Relaciones |
|--------|--------|------------|
| **User** | id, name, email, password | hasMany apuntes, comentarios |
| **Materia** | id, nombre, descripcion, anio | hasMany apuntes |
| **Apunte** | id, user_id, materia_id, titulo, descripcion, ruta_archivo | belongsTo user, materia; hasMany comentarios |
| **Comentario** | id, user_id, apunte_id, contenido | belongsTo user, apunte |
| **Evento** | id, user_id, titulo, fecha_inicio, fecha_fin?, tipo, color | belongsTo user |

---

## Stack técnico

| Capa | Tecnología |
|------|-----------|
| Backend | Laravel 13 + PHP 8.4 |
| Frontend | Livewire v4 + Flux UI v2 + Tailwind v4 |
| Calendar | FullCalendar |
| Auth | Laravel Fortify (login, register, password reset) |
| DB | SQLite (por defecto) |
| Assets | Vite |
| Quality | PHPStan level 7, Pint (Laravel preset) |
