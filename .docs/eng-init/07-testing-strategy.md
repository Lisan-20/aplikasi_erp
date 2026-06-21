# ENG-007: Testing Strategy

- **Date:** 2026-06-13
- **Status:** Open
- **Priority:** Medium

---

## Overview

The project has two placeholder test files (`tests/Feature/ExampleTest.php`, `tests/Unit/ExampleTest.php`) with no real test coverage. Given the project interacts with a legacy database and has auth, registration, and permission logic, tests are critical for safe refactoring.

---

## Test Environment

Tests are already configured to use `DB_CONNECTION=array` (in-memory, no real SQL Server needed). This is correct — maintain this configuration.

---

## Priority Test Coverage

### Priority 1 — Authentication (Feature Tests)

```php
// tests/Feature/AuthTest.php
it('redirects unauthenticated users to login', function () {
    $this->get('/modul')->assertRedirect('/login');
});

it('logs in with valid credentials', function () {
    // Seed a test user in the array driver
    $this->post('/login', ['txt_name' => 'admin', 'txt_pass' => 'password'])
         ->assertRedirect();
    $this->assertSessionHas('id_dd_user');
});

it('rejects invalid credentials', function () {
    $this->post('/login', ['txt_name' => 'wrong', 'txt_pass' => 'wrong'])
         ->assertSessionHasErrors('message');
});
```

---

### Priority 2 — Permission Middleware (Feature Tests)

```php
// tests/Feature/PermissionTest.php
it('blocks access to module without permission', function () {
    // Simulate session with user but no module access
    $this->withSession(['id_dd_user' => 999])
         ->get('/dashboard/99')
         ->assertStatus(403);
});
```

---

### Priority 3 — Patient Registration (Feature Tests)

```php
// tests/Feature/PasienBaruTest.php
it('creates a new patient', function () {
    $this->withSession(['id_dd_user' => 1])
         ->post('/registrasi/pasien-baru', [
             'nama_pasien' => 'John Doe',
             'tgl_lahir' => '1990-01-01',
             'jenis_kelamin' => 'L',
         ])
         ->assertRedirect();
});
```

---

### Priority 4 — Unit Tests for Business Logic

```php
// tests/Unit/PatientServiceTest.php
it('generates zero-padded MR numbers', function () {
    $service = new PatientService();
    expect($service->formatMrNumber(1))->toBe('000001');
    expect($service->formatMrNumber(1234))->toBe('001234');
});
```

---

## Testing Tools

- **PHPUnit 11** — already installed
- Consider adding **Pest PHP** for more expressive syntax:
  ```bash
  composer require pestphp/pest --dev
  ```
- **Mockery** — already installed, use for mocking `DB` in unit tests where needed

---

## Acceptance Criteria

- [ ] Auth login/logout covered by feature tests
- [ ] Unauthenticated redirect covered
- [ ] Permission denial (403) covered
- [ ] At least one happy-path test for new patient registration
- [ ] MR number generation logic covered by unit test
- [ ] `php artisan test` passes with 0 failures
