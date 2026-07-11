# Jungle Notes — Guía de Exposición

## Slide 1 — Portada
- Somos Equipo Iceberg, Programación 3, UTN Formosa 2026
- Jungle Notes: sistema web para gestionar apuntes académicos

## Slide 2 — Problema vs Solución
- **Problema**: apuntes dispersos, sin organización, difíciles de encontrar
- **Solución**: sistema centralizado con búsqueda, organización por materia

## Slide 3 — Objetivos
- CRUD de apuntes con archivos PDF/Word
- Dashboard con métricas
- Bloc de notas rápido
- Materias + comentarios

## Slide 4 — Gestión de Materias
- Crear/editar/eliminar materias
- Cada materia tiene sus apuntes asociados
- Archivos se guardan en `storage/app/public/apuntes/materia_{id}/`

## Slide 5 — Calendario Académico
- FullCalendar.js: vista mensual/semanal/diaria
- Crear eventos (exámenes, presentaciones)
- Feriados nacionales como fondo

## Slide 6 — Bloc de Notas
- Editor simple para notas rápidas
- Se guarda automáticamente al escribir
- Acceso desde el menú principal

## Slide 7 — Sistema de Comentarios
- Comentarios en cada apunte (Livewire, sin recargar)
- Hilo por apunte, colaborativo entre compañeros

## Slide 8 — Stack Tecnológico
- **Frontend**: Tailwind CSS v4 + Livewire v4 + Flux UI v2
- **Backend**: Laravel 12 + PHP 8.3
- **BD**: SQLite (dev) / MySQL (prod) + Eloquent ORM

## Slide 9 — Arquitectura MVC en Livewire
- Livewire elimina la separación Controller/Vista tradicional
- Cada componente maneja estado, lógica y renderizado
- Usuario → Componente → Modelo → Vista Blade

## Slide 10 — Entidades BD
- Materia, Apunte, Comentario, Evento, Nota
- Resaltar Apunte (central del sistema)

## Slide 11 — Demo del Sistema
- **Momento clave**: abrí el navegador y mostrá:
  1. Dashboard con métricas
  2. Subir un apunte (PDF)
  3. Buscar por materia
  4. Calendario con eventos
  5. Bloc de notas

## Slide 12 — Conclusiones
- Centralización de recursos académicos
- Stack moderno y productivo (Laravel + Livewire + Tailwind)
- Desarrollo colaborativo con Git (issues, PRs)
- Próximos pasos: seguridad, caché, más features

## Slide 13 — Cierre
- "¿Preguntas?"
- Agradecer y pasar a preguntas

---

## Tips para la exposición
1. **Corré la app antes**: `composer dev` y dejá el navegador abierto en el dashboard
2. **Avanzá el PowerPoint** con las flechas del teclado
3. **En Slide 11**, minimizá el PowerPoint y mostrá el navegador con la app andando
4. **Si preguntan por seguridad**: mencioná que Fortify maneja auth, validaciones en servidor, y path traversal fixeado
5. **Si preguntan por deploy**: SQLite para dev, MySQL para prod, `storage:link` para archivos
