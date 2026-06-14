# Engineering Initiative Index — SIMRS Laravel Application

- **Date:** 2026-06-13
- **Status:** Active

---

## Purpose

This directory documents engineering improvement findings from the initial codebase review of the SIMRS (Sistem Informasi Manajemen Rumah Sakit) Laravel application. Each document covers a specific area with findings, proposed fixes, and acceptance criteria.

---

## Documents

| # | Title | Priority | Status |
|---|---|---|---|
| [ENG-001](./01-security-critical-fixes.md) | Critical Security Fixes | Critical | Open |
| [ENG-002](./02-authentication-refactor.md) | Authentication System Refactor | High | Open |
| [ENG-003](./03-form-request-validation.md) | Form Request Validation | High | Open |
| [ENG-004](./04-eloquent-models.md) | Eloquent Model Layer for Core Tables | Medium | Open |
| [ENG-005](./05-service-layer-refactor.md) | Service Layer & Fat Controller Refactor | Medium | Open |
| [ENG-006](./06-route-cleanup.md) | Route File Cleanup & Naming | Low | Open |
| [ENG-007](./07-testing-strategy.md) | Testing Strategy | Medium | Open |
| [ENG-008](./08-project-setup-standards.md) | Project Setup Standards | Low | Open |

---

## Recommended Order of Implementation

1. **ENG-001** — Fix security issues first (SQL injection, logout GET, debug route, rate limiting)
2. **ENG-002** — Refactor auth to use Laravel's auth system
3. **ENG-003** — Add Form Request validation to all POST routes
4. **ENG-004** — Create Eloquent models for core tables
5. **ENG-007** — Write tests before large refactors (ENG-005)
6. **ENG-005** — Extract service layer (safe once tests exist)
7. **ENG-006** — Route cleanup (low risk, do anytime)
8. **ENG-008** — Project setup standards (low risk, do anytime)

---

## Stack Reference

- Laravel 12, PHP 8.2+
- React 18 + Inertia.js
- Microsoft SQL Server (`sqlsrv`)
- Vite 4
