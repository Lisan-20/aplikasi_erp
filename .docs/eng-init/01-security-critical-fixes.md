# ENG-001: Critical Security Fixes

- **Date:** 2026-06-13
- **Status:** Open
- **Priority:** Critical

---

## Overview

Several critical security vulnerabilities were identified during initial project review. These must be resolved before any production deployment.

---

## Findings

### 1. SQL Injection in Legacy Helpers

**File:** `app/Helpers/DatabaseHelper.php`

`read_tabel()` and `baca_tabel()` accept raw string interpolation for table name, field, and condition — directly concatenated into SQL queries with no parameterization.

```php
// Current (vulnerable)
$query = "SELECT $field FROM $tabel $kondisi";
return DB::select($query);
```

Additionally, `baca_tabel()` uses `LIMIT 1` which is MySQL syntax and **does not work on Microsoft SQL Server** (the project's actual database).

**Fix:**
- Replace `LIMIT 1` with `TOP 1` for SQL Server compatibility
- Never accept raw condition strings from callers; use Query Builder with bindings
- Audit every call site of `read_tabel()` and `baca_tabel()` across all controllers and replace with direct Query Builder calls

---

### 2. Logout via GET Route

**File:** `routes/web.php` line 24

```php
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
```

A GET-based logout is vulnerable to CSRF: any page (e.g. `<img src="/logout">`) can force a logout without the user's intent.

**Fix:**
```php
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
```
Update frontend logout button to submit a POST form with `@csrf`.

---

### 3. Debug Route Exposed in Production

**File:** `routes/web.php` lines 36–39

```php
Route::get('/debug/menus/{modul}', function($modul) {
    $c = new DashboardController();
    ...
});
```

This route is registered under the protected middleware group but is accessible to any logged-in user and leaks internal menu/permission data.

**Fix:** Remove entirely, or gate with:
```php
if (app()->isLocal()) {
    Route::get('/debug/menus/{modul}', ...);
}
```

---

### 4. No Rate Limiting on Login

**File:** `routes/web.php` line 23

The POST `/login` endpoint has no throttle — brute-force attacks are unrestricted.

**Fix:**
```php
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.post');
```

---

### 5. MD5 Password Hashing

**File:** `app/Http/Controllers/AuthController.php` line 33

MD5 is cryptographically broken and should not be used for password storage. This is a legacy constraint from the inherited `dd_user` table.

**Fix (migration path):**
1. Add a `password_hash` column to `dd_user`
2. On first successful MD5 login, hash the plaintext password with `bcrypt` and store it in `password_hash`
3. Update login logic to prefer `password_hash` (bcrypt) over `password` (MD5)
4. Once all users have migrated, drop MD5 login path

---

## Acceptance Criteria

- [ ] `read_tabel()` and `baca_tabel()` use parameterized queries and `TOP 1`
- [ ] Logout is a `POST` route; frontend updated accordingly
- [ ] Debug route removed from codebase
- [ ] Login endpoint throttled to 5 attempts per minute
- [ ] MD5 migration path documented and implemented
