
# AI & Laravel Boost Custom Conventions

## Facades over Helper Functions
Always favor Laravel facades over their helper function equivalents.
- **Example:** Use `Auth::user()` instead of `auth()->user()`.

## CRUDDY by Design Controllers
Follow a "CRUDDY by Design" convention for all Laravel controllers. Stick to the seven resourceful actions:
- `index`, `create`, `store`, `show`, `edit`, `update`, `destroy`

## Livewire Component Structure
- Properties must be declared first, followed by methods, and the `render` method must always be last.
- Properties must use snake_case (example: `$data_user`), not camelCase.

## Imports
- All class, enum, action, and dependency imports (`use ...`) must be placed at the very top of the file, before any code.

## User Texts
- All user-facing text must be wrapped in the translation helper: `__('text')`.

## Documentation and AI Instructions
When making changes to the codebase:
- Always update both the `README.md` and Copilot/AI instruction files accordingly.

## General
- These conventions are enforced for all code contributions and AI agents (including Copilot) assisting in this project.
- Update this file and the README.md whenever conventions change.

---

_Last updated: February 21, 2026_
