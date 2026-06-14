# Best Practices: SQL & Database Queries

Due to the legacy nature of the database schema (over 4,315 tables/views), we often need to write custom SQL queries rather than relying entirely on Eloquent ORM. 

## 1. Prefer Raw Queries with Sanitized Parameters
When writing complex queries or interacting with legacy schemas where Eloquent models might be too slow or cumbersome, use raw SQL.

- **DO**: Always use parameterized bindings (`?` or `:name`) to sanitize inputs and prevent SQL Injection.
  ```php
  // DO: Parameterized Raw Query
  $patients = DB::select('
      SELECT TOP 100 no_mr, nama_pasien 
      FROM mt_master_pasien 
      WHERE status = ? AND created_at > ?
  ', [$status, $date]);
  ```

- **DON'T**: Never concatenate user input directly into the SQL string.
  ```php
  // DON'T: Vulnerable to SQL Injection
  $patients = DB::select("
      SELECT TOP 100 no_mr, nama_pasien 
      FROM mt_master_pasien 
      WHERE status = '$status' AND created_at > '$date'
  "); // Extremely dangerous!
  ```

## 2. Using the Legacy Database Helpers
The project includes legacy database helper functions `read_tabel()` and `baca_tabel()` in `app/Helpers/DatabaseHelper.php`. 
- **DO**: Use these when making simple legacy queries that have already been standardized in the old system.
- **DON'T**: Use them if they require heavy manual concatenations for conditions. Fall back to `DB::select()` with bindings for complex parameterized queries.

## 3. Handling Case-Sensitive Collation
The MS SQL Server database uses case-sensitive SQL collation. 
- **DO**: Ensure exact case matching when writing string comparisons in your SQL.
- **DON'T**: Assume `WHERE name = 'JOHN'` will match `'John'`. You may need to use `UPPER()` or `LOWER()` functions if you want case-insensitive searches, e.g., `WHERE UPPER(name) = UPPER(?)`.

## 4. Query Builder vs. Raw SQL
For moderate queries, Laravel's Query Builder is safe and naturally parameterizes inputs out of the box.
- **DO**: Use Query Builder when you don't need complex legacy SQL Server specific syntax (like `CROSS APPLY` or specific locking hints).
  ```php
  // DO
  $users = DB::table('dd_user')
             ->where('active', 1)
             ->get();
  ```
- **DON'T**: Force Eloquent relationships on tables that lack proper foreign keys or have compound keys that Eloquent struggles with. In those cases, a well-crafted raw `JOIN` is much better.

## 5. SQL Server Specifics (`TOP` vs `LIMIT`)
- **DO**: Use `TOP` instead of `LIMIT` when writing raw queries for SQL Server.
  ```php
  // DO
  DB::select('SELECT TOP 10 * FROM patients');
  ```
- **DON'T**: Use MySQL-specific syntax.
  ```php
  // DON'T
  DB::select('SELECT * FROM patients LIMIT 10'); // This will fail in SQL Server
  ```
