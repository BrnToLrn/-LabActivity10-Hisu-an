# Lab Activity 10: Barangay Bulletin Board System

A Laravel 12 application featuring Tailwind CSS v3, Eloquent Active Record models, migrations, factories, seeders, dynamic query filters, pagination, and view counters.

---

## Student & Activity Information
- **Last Name**: Hisu-an (or Hisuan)
- **Per-Page Number**: `6` (based on the letter count of the last name: `H-I-S-U-A-N` = 6 letters, satisfying min 6)
- **Custom Category**: `Community Updates` (the 5 categories are: `Announcement`, `Health`, `Peace & Order`, `Ayuda`, and `Community Updates`)
- **Birthday Post Date**: `2026-05-15 08:00:00` (pinned birthday post created in PostSeeder)

---

## Requirements Checklist
1. **Migrations with up/down**: `authors`, `posts`, and `add_views_to_posts_table` all use proper Blueprint methods with tested rollback and re-migration.
2. **Separate Alter Migration**: `views` column added in `add_views_to_posts_table` using `Schema::table`, with `dropColumn('views')` in `down()`.
3. **Eloquent Models**: `Author` and `Post` use explicit `$fillable` (no `$guarded = []`), `$casts` for boolean and datetime values, and defined relationships.
4. **Factories with Faker + State**: `AuthorFactory` and `PostFactory` use `fake()`. `PostFactory` includes a `draft()` state and utilizes the 5 specified categories.
5. **Seeders**: `DatabaseSeeder` executes `AuthorSeeder` and `PostSeeder`.
   - 5 authors (including a Kagawad created manually with `Author::create()`).
   - 51 posts (40 published, 10 drafts, 1 pinned birthday post).
6. **Query Builder Filters**: `/posts` filters published posts only, prioritizes pinned posts (`orderByDesc('is_pinned')`), supports `?q=` (title search) and `?category=`, applied cleanly via Query Builder without raw string concatenation.
7. **Pagination**: Uses `paginate(6)->withQueryString()`, styled with Tailwind, showing `{{ $posts->links() }}` and `Showing x–y of z posts`.
8. **Show Page with Save**: `/posts/{id}` uses `findOrFail`, returns 404 on draft posts, and increments view count via `$post->increment('views')`.
9. **Blade + Tailwind Views**: Both index and show views extend the master layout with title `Barangay Bulletin – Purok Hisu-an`, utilize `@forelse` / `@empty ("No posts match your search.")`, display pinned badges, responsive grids, and properly escaped Blade outputs.

---

## How to Run the Project

1. **Clone and Navigate**:
   ```bash
   cd LabActivity10-Hisu-an
   ```

2. **Install PHP Dependencies**:
   ```bash
   composer install
   ```

3. **Set Up Environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run Migrations & Seeders**:
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Install and Build Frontend (Tailwind CSS v3)**:
   ```bash
   npm install
   npm run build
   ```

6. **Start Development Servers**:
   - **Terminal 1** (Laravel Backend):
     ```bash
     php artisan serve
     ```
   - **Terminal 2** (Vite Dev Server - optional for development):
     ```bash
     npm run dev
     ```

7. **Access the Application**:
   Open [http://127.0.0.1:8000](http://127.0.0.1:8000) or [http://127.0.0.1:8000/posts](http://127.0.0.1:8000/posts) in your browser.
