# ENG-005: Service Layer & Fat Controller Refactor

- **Date:** 2026-06-13
- **Status:** Open
- **Priority:** Medium

---

## Overview

Business logic is currently embedded directly in controllers. Controllers are responsible for generating MR numbers, building menu trees, querying permissions, and writing to multiple tables in a single action. This violates Single Responsibility and makes the code hard to test or reuse.

---

## Specific Problem Areas

### 1. `HandleInertiaRequests::share()` — DB Queries on Every Request

Two DB queries run on **every single page load** to build the sidebar menu:

```php
// HandleInertiaRequests.php
$module = DB::table('dc_modul')->where(...)->first();   // query 1
$hakAkses = DB::table('admin_hak_user_v')->select(...)->get(); // query 2
```

The result is then manually assembled into a menu tree with nested loops.

**Fix:** Extract to a `MenuService` and cache per user:
```php
class MenuService
{
    public function getMenus(int $userId, int $modulId): array
    {
        return Cache::remember("menus.{$userId}.{$modulId}", 300, function () use ($userId, $modulId) {
            // build menu array
        });
    }
}
```

Clear cache on login/logout.

---

### 2. `PasienBaruController` — MR Number Generation Logic

Auto-generating zero-padded MR numbers is business logic that should not live in a controller.

**Fix:** Extract to `PatientService::generateMrNumber()`:
```php
class PatientService
{
    public function generateMrNumber(): string
    {
        $lastMr = Patient::max('no_mr');
        return str_pad((int)$lastMr + 1, 6, '0', STR_PAD_LEFT);
    }

    public function registerNewPatient(StorePatientRequest $request): Patient
    {
        $no_mr = $this->generateMrNumber();
        return Patient::create(['no_mr' => $no_mr, ...$request->validated()]);
    }
}
```

---

### 3. `RegistrasiKunjunganController` — Multi-Table Insert Logic

Visit registration inserts into multiple tables (`reg_kunjungan`, `reg_sep`, etc.). This should be wrapped in a database transaction and extracted to a service.

**Fix:**
```php
class RegistrasiService
{
    public function createVisit(Patient $patient, array $data): Visit
    {
        return DB::transaction(function () use ($patient, $data) {
            $visit = Visit::create([...]);
            // additional related inserts
            return $visit;
        });
    }
}
```

---

## Recommended Service Classes

| Service | Responsibility |
|---|---|
| `PatientService` | MR generation, new patient registration, patient lookup |
| `RegistrasiService` | Visit creation (poli, IGD, rawat inap) with transactions |
| `MenuService` | Build and cache sidebar menus per user/module |
| `PermissionService` | Check user module/sub-menu access |

---

## Acceptance Criteria

- [ ] `MenuService` extracts menu building from `HandleInertiaRequests`
- [ ] Menu queries are cached per user per module (cache cleared on logout)
- [ ] MR number generation is in `PatientService`, not a controller
- [ ] Multi-table inserts in registration flows wrapped in `DB::transaction()`
- [ ] Controllers only: validate → call service → return Inertia response
