# ENG-002: Authentication System Refactor

- **Date:** 2026-06-13
- **Status:** Open
- **Priority:** High

---

## Overview

The application bypasses Laravel's built-in authentication system entirely. Auth is handled via manual session writes and raw DB queries. This prevents use of `auth()->user()`, guards, policies, and any package that integrates with Laravel Auth.

---

## Current State

```php
// AuthController.php
$user = DB::table('dd_user')->whereRaw(...)->first();
Session::put('user', $user);
Session::put('id_dd_user', $user->id_dd_user);
```

```php
// CheckPermission.php
$userId = Session::get('id_dd_user');
if (!$userId) {
    return redirect('/login');
}
```

- The `User` model (`app/Models/User.php`) targets a `users` table that doesn't exist in this project
- `HasApiTokens` (Sanctum) is imported but unused
- `Auth` facade is never called anywhere

---

## Target State

### Step 1: Create a `LegacyUser` Eloquent Model

```php
// app/Models/LegacyUser.php
class LegacyUser extends Authenticatable
{
    protected $table = 'dd_user';
    protected $primaryKey = 'id_dd_user';
    public $timestamps = false;
    protected $hidden = ['password'];
}
```

### Step 2: Create a Custom User Provider

```php
// app/Auth/LegacyUserProvider.php
class LegacyUserProvider implements UserProvider
{
    public function retrieveById($identifier) { ... }
    public function validateCredentials(UserContract $user, array $credentials)
    {
        return hash_equals($user->password, md5($credentials['password']));
    }
}
```

### Step 3: Register the Provider

```php
// app/Providers/AuthServiceProvider.php
Auth::provider('legacy', fn($app, $config) => new LegacyUserProvider());
```

```php
// config/auth.php
'guards' => ['web' => ['driver' => 'session', 'provider' => 'legacy_users']],
'providers' => ['legacy_users' => ['driver' => 'legacy', 'model' => LegacyUser::class]],
```

### Step 4: Update AuthController

```php
if (Auth::attempt(['username' => $username, 'password' => $password])) {
    $request->session()->regenerate();
    return redirect()->intended('/modul');
}
```

### Step 5: Update CheckPermission Middleware

```php
if (!Auth::check()) {
    return redirect('/login');
}
$userId = Auth::id();
```

---

## Benefits

- `auth()->user()` and `auth()->id()` work throughout the application
- Enables use of `@auth` / `@guest` Blade directives (Inertia passes auth state)
- Policies and Gates become usable
- Cleaner `HandleInertiaRequests::share()` — no manual session reading

---

## Acceptance Criteria

- [ ] `LegacyUserProvider` passes all auth through `dd_user` table
- [ ] `Auth::check()` returns `true` for logged-in users
- [ ] `auth()->user()` returns the full `LegacyUser` model
- [ ] `CheckPermission` uses `Auth::check()` and `Auth::id()`
- [ ] Login and logout flows pass feature tests
- [ ] `User.php` model either deleted or repurposed
