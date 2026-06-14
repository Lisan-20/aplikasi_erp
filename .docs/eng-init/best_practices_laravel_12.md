# Best Practices: Laravel 12

Laravel 12 continues the trend of leaner application skeletons, enhanced type-safety, and modern PHP features. Here are the best practices for developing with Laravel 12 in this project:

## 1. Thin Controllers & Fat Services
- **DO**: Keep controllers extremely lightweight. Delegate complex logic to service classes.
  ```php
  // DO
  public function store(StorePatientRequest $request, PatientService $service) {
      $service->registerNewPatient($request->validated());
      return redirect()->route('patients.index');
  }
  ```
- **DON'T**: Write massive logic blocks, run third-party integrations, or send emails directly from the controller.
  ```php
  // DON'T
  public function store(Request $request) {
      // 100 lines of complex logic, sending emails, generating IDs
  }
  ```

## 2. Form Requests for Validation
- **DO**: Use Form Requests to encapsulate validation.
  ```php
  // DO
  public function rules(): array {
      return ['email' => 'required|email|unique:users'];
  }
  ```
- **DON'T**: Validate directly in the controller using `$request->validate()`.
  ```php
  // DON'T
  public function store(Request $request) {
      $request->validate(['email' => 'required']);
  }
  ```

## 3. Strong Typing and Enums
- **DO**: Use strict types and Backed Enums for predictable values.
  ```php
  // DO
  public function setStatus(StatusEnum $status): void {
      $this->status = $status->value;
  }
  ```
- **DON'T**: Pass random strings or numbers for state.
  ```php
  // DON'T
  public function setStatus(string $status): void {
      if ($status === 'active' || $status === '1') { /* ... */ }
  }
  ```

## 4. Eloquent & Database Performance
### The N+1 Problem
- **DO**: Use eager loading when looping through models.
  ```php
  // DO
  $users = User::with('profile')->get();
  foreach ($users as $user) {
      echo $user->profile->address; // No extra queries executed
  }
  ```
- **DON'T**: Call relations inside a loop without eager loading.
  ```php
  // DON'T
  $users = User::all();
  foreach ($users as $user) {
      echo $user->profile->address; // Triggers a DB query every loop iteration!
  }
  ```

### Chunking Large Datasets
- **DO**: Use `chunk()` or `lazy()` when processing thousands of records to save memory.
  ```php
  // DO
  Patient::chunk(1000, function ($patients) {
      foreach ($patients as $patient) { /* ... */ }
  });
  ```
- **DON'T**: Load everything into memory at once.
  ```php
  // DON'T
  $patients = Patient::all(); // Will cause Memory Exhausted Error for huge tables
  ```

## 5. Idempotent Migrations
- **DO**: Check if a table exists before creating it, especially since this uses legacy DB schemas.
  ```php
  // DO
  public function up(): void {
      if (Schema::hasTable('patients')) return;
      Schema::create('patients', function (Blueprint $table) { /* ... */ });
  }
  ```
- **DON'T**: Assume a clean slate.
  ```php
  // DON'T
  public function up(): void {
      Schema::create('patients', function (Blueprint $table) { /* ... */ }); // Will crash if legacy table exists
  }
  ```

## 6. Dependency Injection
- **DO**: Inject dependencies into controllers/methods instead of instantiating them manually.
  ```php
  // DO
  public function index(PatientRepository $repository) {
      return $repository->getAllActive();
  }
  ```
- **DON'T**: Use `new` tightly coupling the class.
  ```php
  // DON'T
  public function index() {
      $repository = new PatientRepository(); // Harder to mock in tests
      return $repository->getAllActive();
  }
  ```
