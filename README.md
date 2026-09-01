# NoteForge 🔥

A lightweight Laravel-style notes manager — built as a practice project
for a full Git & GitHub workflow (commits, branches, pull requests,
merges, merge-conflict resolution, `git revert`, and `git restore`).

## Stack

- PHP 8+ / Laravel-style MVC structure (routes → controller → model → view)
- Blade-style view for listing notes
- SQLite-friendly `Note` model/migration

## Structure

```
app/Http/Controllers/NoteController.php   # add / list / delete / search notes
app/Models/Note.php                       # Note model
database/migrations/..._create_notes_table.php
routes/web.php                            # /notes routes
resources/views/notes/index.blade.php     # notes list view
composer.json                             # Laravel dependencies
.env.example                              # environment config template
```

## Getting it running (on a machine with Composer + PHP)

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

> Note: This zip ships the full Laravel-style source tree and git
> history. Since it was generated in an offline sandbox, the `vendor/`
> folder (third-party packages) is not included — run `composer install`
> once you have internet access to pull those in.

## Project history

Built commit-by-commit to demonstrate a complete Git workflow:

1. Initial commit with README
2. Laravel skeleton (composer.json, .env.example, artisan)
3. Note model + migration
4. NoteController (add/list/delete)
5. Routes + Blade view
6. Feature branch (`feature/search`) merged via pull request
7. A deliberate merge conflict, resolved
8. A reverted commit
9. `git restore` used to discard local changes

See `WORKFLOW.md` for the exact commands used.
