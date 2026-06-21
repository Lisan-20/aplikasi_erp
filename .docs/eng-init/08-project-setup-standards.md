# ENG-008: Project Setup Standards

- **Date:** 2026-06-13
- **Status:** Open
- **Priority:** Low

---

## Overview

Several project-level configuration files still contain Laravel's default scaffolding values. These should be updated to reflect the actual SIMRS project identity and enforce correct Laravel 12 conventions.

---

## Issues

### 1. `composer.json` — Default Project Name

```json
// Current
"name": "laravel/laravel",
"description": "The skeleton application for the Laravel framework.",
```

**Fix:**
```json
"name": "simrs/aplikasi-laravel",
"description": "Sistem Informasi Manajemen Rumah Sakit (SIMRS)",
"keywords": ["simrs", "laravel", "hospital", "inertia"],
```

---

### 2. `bootstrap/app.php` — Laravel 9/10 Style Bootstrap

**File:** `bootstrap/app.php`

The current file uses Laravel 9/10-era singleton bindings:
```php
$app->singleton(Illuminate\Contracts\Http\Kernel::class, App\Http\Kernel::class);
```

Laravel 12 uses the new `Application::configure()` fluent bootstrap:
```php
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(web: __DIR__.'/../routes/web.php')
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [HandleInertiaRequests::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
```

**Fix:** Verify whether `App\Http\Kernel` exists (Laravel 12 removed it). If not, update `bootstrap/app.php` to the new fluent format.

---

### 3. `User` Model Mismatch

`app/Models/User.php` targets a `users` table with `name/email/password` columns that do not exist in this project's database. `HasApiTokens` (Sanctum) is imported but unused.

**Fix options:**
- **Option A:** Delete `User.php`, replace with `LegacyUser.php` pointing to `dd_user` (see ENG-002)
- **Option B:** Keep `User.php` for future new-system users, rename to avoid confusion

---

### 4. `app/Providers/AppServiceProvider.php` — Empty

`register()` and `boot()` methods are empty. As the project grows:

```php
public function boot(): void
{
    // Register custom auth provider (ENG-002)
    // Register macro helpers
    // Configure model strict mode in local env
    Model::shouldBeStrict(! app()->isProduction());
}
```

---

### 5. Unused Service Providers

`AuthServiceProvider.php`, `BroadcastServiceProvider.php`, `EventServiceProvider.php`, and `RouteServiceProvider.php` exist but are likely empty stubs. Audit and remove unused ones, or fill in with real bindings as the project grows.

---

## Acceptance Criteria

- [ ] `composer.json` has correct project name and description
- [ ] `bootstrap/app.php` uses Laravel 12's fluent Application bootstrap
- [ ] `User.php` model resolved (deleted or repurposed)
- [ ] `AppServiceProvider::boot()` enables strict model mode in local/staging
- [ ] Unused service providers removed or properly implemented
