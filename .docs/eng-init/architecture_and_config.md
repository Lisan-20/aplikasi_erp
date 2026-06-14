# High-Level Architecture & Configuration

## 1. High-Level Architecture

The project is a **SIMRS (Sistem Informasi Manajemen Rumah Sakit)** built with a modern monolithic SPA approach, leveraging the Laravel + React + Inertia.js stack.

### Stack Overview
- **Backend**: Laravel 12 on PHP 8.3+.
- **Frontend**: React 18 integrated via Inertia.js (no decoupled API layer required).
- **Bundler**: Vite 4 for fast Hot Module Replacement (HMR) and optimized builds.
- **Database**: Microsoft SQL Server (driver: `sqlsrv`) with over 4,315 legacy tables/views.
- **Authentication**: Custom session authentication using the legacy `dd_user` table.

### Data Flow Pattern (Do's & Don'ts)
- **DO**: Use `Inertia::render()` in your controllers to pass data to React pages.
  ```php
  // DO
  public function show(Patient $patient) {
      return Inertia::render('Patients/Show', ['patient' => $patient]);
  }
  ```
- **DON'T**: Return Blade views or create separate JSON API endpoints for your frontend SPA.
  ```php
  // DON'T
  public function show(Patient $patient) {
      return response()->json($patient); // Avoid for Inertia pages
  }
  ```

## 2. Configuration Locations

### Database Setup
Database configuration defines how the application connects to the MS SQL Server and other data stores.
- **Location:** `.env` and `config/database.php`
- **DO**: Rely on the `.env` file to change database credentials per environment.
  ```env
  DB_CONNECTION=sqlsrv
  DB_HOST=localhost
  DB_DATABASE=simrs
  ```
- **DON'T**: Hardcode credentials directly into `config/database.php` or controller logic.

### Object Storage Service (OSS) / Filesystem
For storing and serving files.
- **Location:** `.env` and `config/filesystems.php`
- **DO**: Use Laravel's Storage facade to interact with files, enabling you to switch disks transparently via `.env`.
  ```php
  // DO
  Storage::disk('s3')->put('reports/123.pdf', $fileContents);
  ```
- **DON'T**: Hardcode local directory paths using raw PHP `file_put_contents` or `public_path()` if the files should be synchronized across servers or to OSS.
  ```php
  // DON'T
  file_put_contents('/var/www/public/reports/123.pdf', $fileContents);
  ```

### Router Setup
Routing definitions dictate how URLs map to controllers and Inertia views.
- **Location:** `routes/web.php`
- **DO**: Group routes by middleware and controller.
  ```php
  // DO
  Route::middleware(['auth', 'check.permission'])->controller(PatientController::class)->group(function () {
      Route::get('/patients', 'index');
      Route::post('/patients', 'store');
  });
  ```
- **DON'T**: Put closures or business logic inside `routes/web.php`.
  ```php
  // DON'T
  Route::get('/patients', function () {
      $patients = DB::table('patients')->get();
      return Inertia::render('Patients', ['data' => $patients]);
  });
  ```

## 3. Background Jobs & Queue Architecture
When dealing with heavy tasks (e.g., generating massive Excel reports, calling external BPJS APIs), use Laravel Queues.
- **Location:** `config/queue.php` and `.env` (`QUEUE_CONNECTION=database` or `redis`).
- **DO**: Dispatch heavy logic to a Job.
  ```php
  // DO
  GenerateMonthlyReport::dispatch($user);
  return back()->with('message', 'Report is generating in the background.');
  ```
- **DON'T**: Execute heavy logic synchronously during the web request, making the user wait.
  ```php
  // DON'T
  public function generateReport() {
      sleep(30); // Simulating heavy task... the browser hangs for 30 seconds!
      return back();
  }
  ```

## 4. Event & Listener Architecture
To decouple application logic, use Events. For example, when a patient registers, multiple independent things might happen (send SMS, update external system).
- **DO**: Fire an event and let listeners handle the side effects.
  ```php
  // DO
  event(new PatientRegistered($patient));
  ```
- **DON'T**: Hardcode all side-effects into the controller.
  ```php
  // DON'T
  $smsService->send($patient);
  $bpjsApi->sync($patient);
  ```
