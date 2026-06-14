# ENG-003: Form Request Validation

- **Date:** 2026-06-13
- **Status:** Open
- **Priority:** High

---

## Overview

No Form Requests exist in the project. All POST controllers read raw input without validation, type-checking, or sanitization. This risks data integrity issues and makes controller code harder to read and test.

---

## Current State

```php
// AuthController.php
$username = $request->input('txt_name');
$password = $request->input('txt_pass');
// No validation — if either is missing, the DB query just returns null
```

Controllers across the registrasi module follow the same pattern.

---

## What To Do

Create a Form Request per POST route:

```bash
php artisan make:request LoginRequest
php artisan make:request StorePatientRequest
php artisan make:request StoreVisitRequest
php artisan make:request StorePaketPoliRequest
php artisan make:request StoreRawatInapRequest
```

### Example: `LoginRequest`

```php
class LoginRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'txt_name' => ['required', 'string', 'max:100'],
            'txt_pass' => ['required', 'string', 'min:1'],
        ];
    }
}
```

### Example: `StorePatientRequest`

```php
class StorePatientRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nama_pasien'   => ['required', 'string', 'max:100'],
            'tgl_lahir'     => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'alamat'        => ['nullable', 'string'],
            // ... other fields
        ];
    }
}
```

### Controller Usage

```php
// Before
public function store(Request $request) { ... }

// After
public function store(StorePatientRequest $request) { ... }
```

Validation errors are automatically returned as a redirect-with-errors response (Inertia handles this as `$page.props.errors`).

---

## Priority Order

1. `LoginRequest` — auth is the entry point
2. `StorePatientRequest` (`PasienBaruController::store`)
3. `StoreVisitRequest` (`RegistrasiKunjunganController::storePoli` and `storeIgd`)
4. All remaining POST routes in registrasi module

---

## Acceptance Criteria

- [ ] Every POST route uses a typed `FormRequest` parameter
- [ ] Required fields are validated before DB insert
- [ ] Frontend displays validation errors via Inertia's `$page.props.errors`
- [ ] No raw `$request->input()` calls without prior validation
