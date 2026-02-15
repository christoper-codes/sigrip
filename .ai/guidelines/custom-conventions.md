# Custom Laravel Coding Conventions

## Facades over Helper Functions
Always favor Laravel facades over their helper function equivalents.
- **Example:** Use `Auth::user()` instead of `auth()->user()`.

## CRUDDY by Design Controllers
Follow a "CRUDDY by Design" convention for all Laravel controllers. Stick to the seven resourceful actions:
- `index`, `create`, `store`, `show`, `edit`, `update`, `destroy`

## Documentation and AI Instructions
When making changes to the codebase:
- Always update both the `README.md` and Copilot/AI instruction files accordingly.

---

These conventions are enforced for all code contributions in this project. AI agents and developers must adhere to these guidelines for consistency and maintainability.
