# ENG-004: Eloquent Model Layer for Core Tables

- **Date:** 2026-06-13
- **Status:** Open
- **Priority:** Medium

---

## Overview

All database access currently uses `DB::table('table_name')` raw query builder calls scattered across controllers. No Eloquent models exist for core domain tables. This makes relationships, casting, scopes, and testing much harder.

---

## Current State

```php
// PasienBaruController.php (example)
DB::table('mt_master_pasien')->insert([...]);
DB::table('reg_kunjungan')->insertGetId([...]);
DB::table('mt_master_pasien')->where('no_mr', $no_mr)->first();
```

The only Eloquent models present are:
- `User` — points to a non-existent `users` table
- `Patient` — existence confirmed but usage unclear

---

## Core Tables That Need Models

| Table | Model Name | Notes |
|---|---|---|
| `mt_master_pasien` | `Patient` | Primary key `no_mr`, no `id`, no timestamps |
| `dd_user` | `LegacyUser` | Custom auth (see ENG-002) |
| `reg_kunjungan` | `Visit` | Registration visits |
| `dc_poli` | `Poli` | Clinic/department |
| `dc_ruangan` | `Room` | Hospital rooms |
| `dc_dokter` | `Doctor` | Doctors |
| `dc_modul` | `Module` | App modules |
| `admin_hak_user_v` | — | DB view, use scoped query on `LegacyUser` |

---

## Model Setup Pattern (Legacy Tables)

```php
class Patient extends Model
{
    protected $table = 'mt_master_pasien';
    protected $primaryKey = 'no_mr';
    public $incrementing = false;   // no_mr is zero-padded string
    public $keyType = 'string';
    public $timestamps = false;     // legacy table has no created_at/updated_at

    protected $fillable = [
        'no_mr', 'nama_pasien', 'tgl_lahir', 'jenis_kelamin', 'alamat',
        // ...
    ];

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class, 'no_mr', 'no_mr');
    }
}
```

---

## Key Considerations

- Most legacy tables have **no `created_at`/`updated_at`** — always set `public $timestamps = false`
- Primary keys are often non-integer (e.g. `no_mr` is zero-padded like `000123`) — set `$incrementing = false` and `$keyType = 'string'`
- SQL Server uses case-sensitive collation — raw `whereRaw()` with `COLLATE` is still needed for auth; regular `where()` is fine for non-sensitive columns
- Avoid MySQL-specific syntax (`LIMIT`, backticks) in any raw queries inside models — use `TOP` and bracket identifiers `[column]`

---

## Acceptance Criteria

- [ ] `Patient` model created with correct table name, primary key, and `$timestamps = false`
- [ ] `Visit` model created with relationship to `Patient`
- [ ] `LegacyUser` model created (see ENG-002)
- [ ] Controllers updated to use models instead of raw `DB::table()` for primary CRUD operations
- [ ] Existing behavior unchanged (verified by feature tests)
