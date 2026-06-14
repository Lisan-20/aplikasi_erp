# Best Practices: PHP 8.3

PHP 8.3 brings a wealth of features that improve type safety, reduce boilerplate, and increase performance. When working on this application, adhere to the following modern PHP standards:

## 1. Constructor Property Promotion
- **DO**: Define and initialize properties directly in the constructor.
  ```php
  // DO
  class UserService {
      public function __construct(private readonly UserRepository $repository) {}
  }
  ```
- **DON'T**: Declare properties, pass them in constructor, and manually assign them.
  ```php
  // DON'T
  class UserService {
      private UserRepository $repository;
      public function __construct(UserRepository $repository) {
          $this->repository = $repository;
      }
  }
  ```

## 2. Match Expressions over Switch
- **DO**: Use `match` for strict and clean conditional assignments.
  ```php
  // DO
  $color = match ($status) {
      'active' => 'green',
      'inactive' => 'red',
      default => 'gray',
  };
  ```
- **DON'T**: Use verbose `switch` statements with `break`.
  ```php
  // DON'T
  switch ($status) {
      case 'active':
          $color = 'green';
          break;
      case 'inactive':
          $color = 'red';
          break;
      default:
          $color = 'gray';
  }
  ```

## 3. Nullsafe Operator
- **DO**: Use `?->` to safely chain method calls without null pointer exceptions.
  ```php
  // DO
  $city = $user->profile?->address?->city;
  ```
- **DON'T**: Write deep nested `if` statements to check for nulls.
  ```php
  // DON'T
  if ($user !== null && $user->profile !== null && $user->profile->address !== null) {
      $city = $user->profile->address->city;
  }
  ```

## 4. Typed Class Constants & Readonly Classes
- **DO**: Strongly type constants and make DTOs readonly for immutability.
  ```php
  // DO
  readonly class PatientDTO {
      public const string TYPE_REGULAR = 'regular';
      public function __construct(public string $name) {}
  }
  ```
- **DON'T**: Leave constants untyped or DTO properties mutable when they shouldn't change.
  ```php
  // DON'T
  class PatientDTO {
      const TYPE_REGULAR = 'regular'; // PHP 8.2 and older style
      public string $name;
  }
  ```

## 5. json_validate() Function (New in 8.3)
- **DO**: Use `json_validate()` to check if a string is valid JSON without decoding it, which uses much less memory.
  ```php
  // DO
  if (json_validate($payload)) {
      // It's valid JSON
  }
  ```
- **DON'T**: Decode JSON just to catch an error.
  ```php
  // DON'T
  json_decode($payload);
  if (json_last_error() === JSON_ERROR_NONE) {
      // It's valid JSON
  }
  ```

## 6. Named Arguments
- **DO**: Use named arguments when a function has many optional parameters. This makes the code self-documenting.
  ```php
  // DO
  $client->getUsers(role: 'admin', includeInactive: true);
  ```
- **DON'T**: Rely on remembering parameter order, injecting random `null` values.
  ```php
  // DON'T
  $client->getUsers('admin', null, null, null, true);
  ```

## 7. First-class Callable Syntax
- **DO**: Use `(...)` to easily create closures from methods.
  ```php
  // DO
  $names = array_map($this->formatName(...), $users);
  ```
- **DON'T**: Use older string arrays or manual closures if unnecessary.
  ```php
  // DON'T
  $names = array_map([$this, 'formatName'], $users);
  ```
