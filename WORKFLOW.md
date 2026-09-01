# Git & GitHub Workflow Log — NoteForge

This file documents every step performed in this repository, in order,
with the exact commands. Everything up to "Push to GitHub" has already
been done for you inside this folder (it's a real local git repo — check
`git log`). You only need to do the GitHub-side steps yourself, since
creating a repo on your account and pushing requires your own GitHub
login and network access.

## 1. Create a GitHub repository (do this yourself)

1. Go to https://github.com/new
2. Repository name: `noteforge` (or any name you like)
3. Leave it **empty** — do NOT initialize with a README, since this
   folder already has one.
4. Click **Create repository**. Copy the URL it gives you, e.g.
   `https://github.com/<your-username>/noteforge.git`

## 2. Clone it locally (or just reuse this folder)

Normally you'd run:
```bash
git clone https://github.com/<your-username>/noteforge.git
```
Since this zip already contains a fully-built local repo with history,
you can instead just point *this* folder at your new empty GitHub repo
(step 6 below) instead of cloning fresh.

## 3. Project + README

`README.md` plus a Laravel-style skeleton (`composer.json`, `.env.example`,
`artisan`, `app/Models/Note.php`, `app/Http/Controllers/NoteController.php`,
`routes/web.php`, `resources/views/notes/index.blade.php`) were added.

## 4. Commits made (5+)

```
git commit -m "Initial commit: add README"
git commit -m "Add Laravel-style project skeleton (composer.json, .env.example, artisan)"
git commit -m "Add Note model and migration"
git commit -m "Implement NoteController with add/list/delete actions"
git commit -m "Add routes and Blade view for notes list"
```

## 5. Feature branch + changes

```bash
git checkout -b feature/search
# added search() to NoteController + a /notes/search route
git commit -m "Add search-notes feature on feature branch"
```

## 6. Push branch + create Pull Request (do this yourself)

```bash
git remote add origin https://github.com/<your-username>/noteforge.git
git push -u origin main
git push -u origin feature/search
```
Then on GitHub: **Compare & pull request** → base `main` ← compare
`feature/search` → **Create pull request**.

Locally, the merge was already simulated with:
```bash
git checkout main
git merge --no-ff feature/search -m "Merge pull request: add search-notes feature (feature/search -> main)"
```

## 7. Merge the PR into main

On GitHub, click **Merge pull request**. (Already reflected locally in
the commit above.)

## 8. Create and resolve a merge conflict

Two branches (`hotfix/version-fix` and `feature/version-bump`, both
branched from the same commit) edited the same line of `composer.json`:
```bash
git checkout -b hotfix/version-fix
# edited the "description" field
git commit -m "Bump description to v1.0.1-hotfix (main branch)"
git checkout main
git merge --no-ff hotfix/version-fix

git checkout -b feature/version-bump <pre-hotfix commit>
# edited the same "description" field differently
git commit -m "Bump description to v1.1 (feature branch)"
git checkout main
git merge feature/version-bump
# CONFLICT (content): Merge conflict in composer.json
```
Resolved by editing `composer.json` to remove the `<<<<<<<`, `=======`,
`>>>>>>>` markers and combine both changes into one description, then:
```bash
git add composer.json
git commit -m "Resolve merge conflict: combine version bump and hotfix"
```

## 9. `git revert`

A bad commit was added on purpose, then reverted (this creates a new
commit that undoes it, keeping full history — safer than rewriting
history):
```bash
git commit -m "Accidentally add debug function"
git revert --no-edit HEAD
```

## 10. `git restore`

Discarding an unwanted local edit before committing:
```bash
git restore README.md              # discard unstaged changes to a file
git restore --staged scratch.txt   # unstage a file (keep the edit, just unstage it)
```

## 11. Push everything to GitHub (do this yourself)

```bash
git remote add origin https://github.com/<your-username>/noteforge.git
git push -u origin main
```
(If you already added the remote in step 6, just run `git push`.)

## Running the app for real

This zip has the full Laravel-style source tree but not `vendor/`
(third-party packages), since it was built offline. Once you have
Composer + internet:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## Quick command reference

| Goal | Command |
|---|---|
| See history as a graph | `git log --oneline --graph --all` |
| New branch | `git checkout -b <name>` |
| Merge a branch | `git merge <name>` |
| Merge, always making a merge commit | `git merge --no-ff <name>` |
| Abort a conflicted merge | `git merge --abort` |
| Undo a commit safely (new commit) | `git revert <commit>` |
| Discard local file changes | `git restore <file>` |
| Unstage a file | `git restore --staged <file>` |
