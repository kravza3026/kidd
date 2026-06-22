# Kidd Admin — Design System & UX Spec

**Status:** Draft for approval · **Date:** 2026-06-22 · **Owner:** Edward Z.

## Purpose

Replace the prototype admin (generic Blade + `@tailwindplus/elements` template) with a **high-end, production-grade admin** for the kidd / pania storefront: a deliberate, reusable **design system** and component library designed up front for every planned feature (core commerce, inventory/barcodes, Meilisearch, taxonomy, content/ops, platform, broadcasting). This is a finished product, not a prototype — every page goes deep.

## Decisions (locked with the user)

- **Stack:** Livewire 3 + Alpine on Blade (reactive, server-driven; no SPA). Real-time via existing Reverb.
- **Aesthetic:** Refined-neutral (Linear/Vercel-like) with **olive** (`#A8BA66`) reserved for primary/active/focus.
- **Shell:** Collapsible icon⇄label sidebar + top bar + **⌘K command palette** + breadcrumbs + notifications center.
- **Component depth:** Full system now + a living **`/admin/design`** style-guide gallery.
- **Admin i18n:** UI translatable **RO / RU / EN** with switcher (`lang/*/admin.php`).
- **Charts:** ApexCharts (dark-aware).
- **Premium additions (all selected):** audit log + per-record timeline (spatie/activitylog); saved views + CSV/Excel export + bulk actions; command-palette record search + quick actions; safety & polish (unsaved-changes guard, optimistic UI + skeletons, toasts, full keyboard nav/shortcuts, WCAG AA).
- **Editing pattern:** Full-page create/edit/show (no drawers for forms). Tables collapse to card lists on mobile.
- **Defaults to confirm:** (1) Comfortaa display + **Inter** for dense data; (2) add `maatwebsite/excel` for `.xlsx`.

## New dependencies

- composer: `livewire/livewire`, `maatwebsite/excel` (xlsx export). spatie/activitylog already installed.
- npm: `apexcharts`. Comfortaa already wired; add Inter (self-hosted or Google Fonts) for data.

## Architecture

- **Livewire pages** under `App\Livewire\Admin\{Module}\{Index,Create,Edit,Show}` render full-page components extending a shared `AdminPage` base (sets layout, breadcrumbs, page title, auth). Stub controllers (`Admin\*Controller`) are retired; `routes/admin.php` maps to Livewire route components, still **id-bound** and **`module:`-gated**, authorized by existing policies/permissions.
- **Shared traits:** `WithDataTable` (sort/filter/search/pagination/bulk/saved-views/export), `WithUnsavedGuard`, `LogsAdminActivity`.
- **Blade component kit** under `resources/views/components/admin/**` (and `App\View\Components\Admin\*` where logic is needed) — consumed by Livewire and plain Blade alike.
- The Categories CRUD already built in Blade is **migrated** to this system as the reference implementation.

## Design tokens (`resources/css/admin.css`)

Semantic CSS variables (light + `.dark`) registered as Tailwind colors so dark mode is DRY:

- Surfaces: `--canvas`, `--surface`, `--surface-2`, `--surface-3` (elevated), `--line`, `--line-strong`.
- Text: `--ink`, `--ink-muted`, `--ink-subtle`.
- Brand/intent: `--olive`, `--dark-olive`, `--olive-soft`; `--danger`, `--warning`, `--success`(=olive), `--info`.
- Neutral ramp tuned for AA contrast in both modes.
- **Density toggle** (comfortable/compact) via a `data-density` attribute on `<html>` scaling row/control padding; persisted in localStorage.
- Fonts: `--font-display` (Comfortaa), `--font-sans` (Inter). Radius `lg`/`xl`, 8px spacing grid, layered shadows `xs/sm/md`, AA focus ring (olive).

## App shell

- **Sidebar:** collapsible (icon-rail ⇄ labels, state remembered), grouped nav for all modules with permission/Pennant gating; active states olive; sections: Dashboard, Catalog (products, categories, taxonomy), Sales (orders, customers), Inventory (stock, warehouses, barcodes), Content (vacancies, applications, inquiries, pages), Platform (users, roles, settings), plus Audit.
- **Top bar:** global search, ⌘K trigger, density toggle, theme toggle, language switcher, notifications bell, user menu (logout works).
- **Command palette (⌘K):** fuzzy navigate; search products/orders/customers; quick actions (create entity, toggle theme/density, jump to settings). Keyboard-first.
- **Breadcrumbs** under the top bar reflecting the route hierarchy.
- **Notifications center:** bell → recent dropdown + dedicated page; backed by database notifications; live via Reverb (Phase 7).

## Component inventory (built now, documented at `/admin/design`)

Primitives: button (variants/sizes/loading/icon), input, textarea, **select / combobox / multiselect / tag-input**, checkbox, radio, **toggle**, **date & datetime picker**, money input, **translatable field (RO/RU/EN tabs)**, file **dropzone** + media-gallery manager, barcode display + **scanner field** (camera/USB, Phase 2).

Surfaces & feedback: card, **stat/metric card**, panel/section, tabs, **modal**, **drawer/sheet**, **slide-over**, **toast**, dropdown menu, tooltip, popover, banner/alert, **empty state**, **skeleton**, **confirmation dialog**, progress, **stepper/wizard**, badge/chip, avatar, key-value list, **activity timeline**, ApexCharts wrappers (area/bar/donut/sparkline).

Navigation: sidebar, breadcrumbs, **command palette**, pagination, page header + actions.

## Data-table system (one reusable component)

Server-side sort, per-column filters, global search, debounced; **bulk actions** with select-all-across-pages; **column visibility/reorder**; **per-user saved views** (filters+columns persisted); **CSV (native stream) + Excel (maatwebsite)** export; sticky header; density-aware rows; **inline edit** for simple fields; **mobile → card list**. Every entity index is a thin config over this.

## Forms

Full-page, sectioned cards; inline validation with field-level errors; **unsaved-changes guard** (beforeunload + Livewire navigate); translatable tabs; dropzone + gallery reordering; money/barcode; ApexCharts where relevant. Complex editors are full-page multi-section/wizard: **Product + variant-matrix generator** (color×size → rows with auto SKU/barcode, bulk fill) and **Order builder** (variant search + line items + addresses + totals).

## Cross-cutting

- **i18n:** all chrome via `__()` from `lang/{ro,ru,en}/admin.php`; switcher sets admin locale (separate from storefront URL locale).
- **Audit:** `LogsActivity` on every admin-managed model (logFillable, logOnlyDirty); per-record **timeline** tab; global **Audit** page (filter by user/subject/event) using the data-table.
- **Safety/polish:** optimistic UI + skeleton loaders on every async list/form; toast feedback on actions; unsaved guard; keyboard shortcuts (g+key nav, ⌘K, j/k rows, etc.); WCAG AA focus/ARIA/contrast; reduced-motion respect.
- **Performance:** Livewire lazy components, deferred loads, query scoping, eager loads.

## Living style guide — `/admin/design`

A gated admin page rendering every component with states (default/hover/disabled/loading/error), light/dark, both densities, and copy-paste usage. Serves as the contract and regression surface.

## Testing & verification

- Pest feature tests per Livewire page (auth/permission/validation/CRUD/403/module-gate) using `Livewire::test`.
- Pest **browser** tests (headed via `PEST_BROWSER_HEADED`) for key flows: command palette, table filter+bulk+export, product+variant matrix, order builder, theme/density/lang toggles, dark mode.
- `php artisan test`, `vendor/bin/pint`, `npx prettier`, `npm run build` green.
- Manual: `cp.kidd.test` — shell, palette, dark/density/lang, a full entity CRUD, `/admin/design` gallery.

## Jira / sequencing

New epic **“Admin design system & shell”** (foundation), then existing Phase 1–8 entity epics implement on Livewire + this kit. Categories migrated first as reference; plan file `velvet-kindling-flask.md` updated to reflect Livewire. Commit per phase (user preference).

## Out of scope (YAGNI for now)

Multi-tenant theming/white-label, customizable dashboards per user, in-app theme-color picker, offline mode.
