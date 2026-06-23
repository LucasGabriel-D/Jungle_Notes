# CHANGELOG — Dashboard Fix

## Problema original

- **Dashboard anidado**: La rama `dvlp/EmaCardozo` de Emanuel tenía un dashboard con doble layout: el `<x-layouts::app>` renderizaba la sidebar Flux completa, y DENTRO del contenido del dashboard había una segunda sidebar Alpine.js con navegación propia (Panel General, Mis Materias, Bloc de Notas, Calendario, Equipo Iceberg). Esto producía un layout roto con dos sidebars visibles al mismo tiempo.
- **Landing pages duplicadas**: Existían dos variantes de landing page sin resolver: `iniciomorado.blade.php` (tema morado, activa en `develop`/`main`) e `inicioverde.blade.php` (tema verde, activa en `dvlp/EmaCardozo`), cada una vinculada a una rama distinta sin forma de elegir entre ellas.

## Archivos modificados

| Archivo | Cambio |
|---|---|
| `.env` | + `APP_LANDING_THEME=morado` |
| `.env.example` | + `APP_LANDING_THEME=morado` |
| `config/app.php` | Nueva config `landing_theme` con valor default `morado` |
| `routes/web.php` | Landing dinámica: elige `inicioverde` o `iniciomorado` según `config('app.landing_theme')` |
| `resources/views/layouts/app/sidebar.blade.php` | Nav items de Emanuel integrados en la sidebar Flux (Mis Materias, Bloc de Notas, Calendario, Equipo Iceberg) |
| `resources/views/dashboard.blade.php` | Sin cambios — ya usaba la versión Flux correcta sin sidebar anidada |

## Decisiones tomadas

1. **Sidebar unificada con Flux**: Se migraron los nav items del sidebar Alpine.js de Emanuel al sidebar nativo de Flux, manteniendo la consistencia visual del Starter Kit. La sidebar Alpine.js incrustada dentro del dashboard se descarta por completo.
2. **Landing dinámica vía `APP_LANDING_THEME`**: Se agregó una variable de entorno en `.env` que permite elegir entre tema `morado` (`iniciomorado`) y `verde` (`inicioverde`). Default: `morado`.
3. **Rutas placeholder**: `Calendario` y `Equipo Iceberg` quedaron con `href="#"` hasta que se definan sus rutas reales.

## Pendientes

- Definir rutas reales para **Calendario** y **Equipo Iceberg** y actualizar los `href` en `sidebar.blade.php`.

## Resultado de tests

| Suite | Resultado |
|---|---|
| **Pint (lint)** | PASS — 56 files |
| **PHPStan (level 7)** | OK — 0 errors |
| **PHPUnit** | 19 passed, 5 skipped (esperado — Flux Pro passkey), 0 failures, 44 assertions |
