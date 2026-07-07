# Jungle_Notes

Sistema web responsive para centralizar, buscar, descargar y comentar apuntes académicos, construido sobre el [Laravel Livewire Starter Kit](https://github.com/laravel/livewire-starter-kit).

## Features

- **Dashboard Principal**: Panel con métricas globales (total de apuntes y materias) y actividad reciente.
- **Gestión de Apuntes (CRUD)**: Interfaz Livewire para subir, buscar (con filtrado inteligente) y eliminar archivos.
- **Almacenamiento Local Estructurado**: Organización automática en `storage/app/public/apuntes/materia_{id}/`.
- **Comentarios Dinámicos**: Sistema de comentarios en tiempo real integrado en el listado de apuntes.
- **Calendario Académico**: Calendario interactivo con FullCalendar para gestionar exámenes, presentaciones y eventos.
- **Bloc de Notas**: Editor rápido de notas personales.
- **Materias (CRUD)**: Administración de materias con detalle de apuntes asociados.
- **Autenticación**: Register + Login + Password Reset via Laravel Fortify.

## Stack

- **Framework**: Laravel 12
- **Frontend**: Livewire v4, Flux UI v2, Tailwind CSS v4
- **Base de datos**: SQLite / MySQL / MariaDB
- **Auth**: Laravel Fortify
- **Calendario**: FullCalendar v6

## Instalación Rápida

1. Configurar credenciales de Flux (requerido):
   ```bash
   composer config http-basic.composer.fluxui.dev "$FLUX_USERNAME" "$FLUX_LICENSE_KEY"
   ```

2. Instalar dependencias:
   ```bash
   composer install
   npm install && npm run build
   ```

3. Configurar entorno:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configurar base de datos en `.env` y ejecutar migraciones:
   ```bash
   php artisan migrate --seed
   ```

5. Crear enlace simbólico para archivos locales:
   ```bash
   php artisan storage:link
   ```

## Comandos Útiles

| Comando | Descripción |
|---|---|
| `composer dev` | Inicia servidor + queue + Vite |
| `composer test` | Ejecuta lint + phpstan + phpunit |
| `composer lint` | Corrige estilo con Pint |
| `composer types:check` | PHPStan level 7 |

## Equipo

Proyecto desarrollado por **Equipo Iceberg** para Programación III:

- Cardozo Emanuel
- Cardozo Mauricio
- Antonelli Lucas
- Britez Santiago
