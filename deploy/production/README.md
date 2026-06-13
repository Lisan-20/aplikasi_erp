# Production Deployment (Planned)

Not yet implemented. This directory will mirror `deploy/staging/` with
production-hardening differences:

- `APP_ENV=production`, `APP_DEBUG=false` enforced.
- `route:cache` enabled — requires refactoring the closure-based routes in
  `routes/web.php` and `routes/api.php` to controller methods first.
- TLS termination (reverse proxy / load balancer).
- Resource limits on compose services.
- Separate `.env.production.example` with production DB credentials.

See `deploy/staging/` for the current reference setup.
