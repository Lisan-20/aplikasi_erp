# Deployment

Docker setups for the SIMRS application, one subdirectory per environment:

- [`staging/`](staging/README.md) — Laravel Octane + FrankenPHP, external SQL Server, ready to use.
- [`production/`](production/README.md) — planned, not yet implemented.

Each environment's `docker-compose.yml` builds from the project root as the
Docker context (`context: ../..`) so the multi-stage `Dockerfile` can access
`composer.json`, `package.json`, and the application source. The root
`.dockerignore` keeps `vendor/`, `node_modules/`, and other unneeded paths out
of the build context.
