# AGENTS.md — Jungle_Notes

Laravel Livewire Starter Kit (Livewire v4 + Flux UI v2 + Fortify + Tailwind v4).

## Setup gotchas

- **Flux credentials required** before `composer install`:
  `composer config http-basic.composer.fluxui.dev "$FLUX_USERNAME" "$FLUX_LICENSE_KEY"`
- `.npmrc` has `ignore-scripts=true` — build scripts won't run postinstall hooks.
- Default DB is SQLite. Sessions, cache, and queue all use `database` driver (tables in migrations).

## Commands

| Run | What it does |
|---|---|
| `composer dev` | `artisan serve` + `queue:listen` + `npm run dev` (Vite) concurrently |
| `composer test` | `config:clear` → `pint --test` → `phpstan analyse` → `artisan test` (must pass in order) |
| `composer lint` | `pint --parallel` (auto-fix) |
| `composer types:check` | `phpstan analyse` (level 7) |
| `php artisan test --filter=NameTest` | single test |

## Architecture

- **Auth**: Fortify with registration + password reset only. No email verification, no 2FA. Redirect: `/dashboard`.
- **Routes**: `routes/web.php` (home, dashboard via controller, materias resource, Livewire `/apuntes`, comentarios resource), `routes/api.php` (GET/POST `/apuntes`), `routes/settings.php`.
- **Domain models**: `Materia` (subject), `Apunte` (note with file upload), `Comentario` (comment). All in `app/Models/`.
- **Livewire components**: `ManageApuntes` (CRUD with file uploads, search), `ComentariosApunte` (nested in each apunte row). Under `app/Livewire/`.
- **File uploads**: stored in `storage/app/public/apuntes/materia_{id}/` via `public` disk. Run `php artisan storage:link` to serve.

## Conventions

- Pint with `laravel` preset. PHPStan level 7 on `app/`, `bootstrap/`, `config/`, `database/`, `routes/`.
- `Date` uses `CarbonImmutable`. Production: `DB::prohibitDestructiveCommands()`, password min 12 + mixed/uncompromised.
