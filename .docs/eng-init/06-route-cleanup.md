# ENG-006: Route File Cleanup & Naming

- **Date:** 2026-06-13
- **Status:** Open
- **Priority:** Low

---

## Overview

`routes/web.php` has inconsistent import style, missing named routes, and an exposed debug closure. This makes the routes harder to read and prevents using `route()` helper reliably throughout the app.

---

## Issues

### 1. Inconsistent Controller Import Style

Some controllers are imported at the top of the file, others are referenced inline with full FQCN:

```php
// Top of file (good)
use App\Http\Controllers\PasienBaruController;

// Mid-file inline (bad — inconsistent)
Route::get('/cari-pasien', [\App\Http\Controllers\Registrasi\CariPasienController::class, 'index'])
```

**Fix:** Add all controller imports to the `use` block at the top of `web.php`.

---

### 2. Missing Named Routes

The following routes have no `->name()`:

```php
Route::get('/rawat-inap/form/{no_mr}', [...]);
Route::post('/rawat-inap/form/{no_mr}', [...]);
Route::get('/edit-data', [...]);
Route::post('/edit-data', [...]);
Route::get('/paket-poli/form/{no_mr}', [...]);
Route::post('/paket-poli/form/{no_mr}', [...]);
Route::get('/mcu/form/{no_mr}', [...]);
Route::post('/mcu/form/{no_mr}', [...]);
Route::get('/penunjang-medis/form/{no_mr}', [...]);
Route::post('/penunjang-medis/form/{no_mr}', [...]);
Route::get('/igd-malam/form/{no_mr}', [...]);
Route::post('/igd-malam/form/{no_mr}', [...]);
```

**Fix:** Add names following existing convention, e.g.:
```php
Route::get('/rawat-inap/form/{no_mr}', [...])
    ->name('registrasi.rawat-inap.form');
```

---

### 3. Debug Route in Production

```php
Route::get('/debug/menus/{modul}', function($modul) {
    $c = new DashboardController();
    $r = $c->show($modul);
    return $r->toResponse(request())->getData();
});
```

This leaks menu structure and permissions to any logged-in user.

**Fix:** Remove entirely. Use `php artisan tinker` for debug inspection.

---

### 4. Legacy Route Catcher Position

The wildcard `/{legacy_dir}/{legacy_file}` route should always be declared **last** within its group to avoid swallowing specific routes accidentally. Verify ordering is correct after all named routes are added.

---

## Acceptance Criteria

- [ ] All controllers imported via `use` statements at top of `web.php`
- [ ] Every route has a `->name()`
- [ ] Debug route removed
- [ ] `php artisan route:list` shows no unnamed routes in web.php
- [ ] `route()` helper works for all routes in frontend/backend
