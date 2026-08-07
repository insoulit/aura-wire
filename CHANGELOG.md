# Changelog

All notable changes to `insoulit/aura-wire` will be documented in this file.

## [1.2.0] - 2026-08-07

### Added
- Responsive mobile navigation to `x-aura::header` component with hamburger menu toggle.
- Pill shape support (`pill` prop) for `x-aura::button` component (`rounded-full`).
- Action icon button component (`x-aura::icon-button`).
- Action dropdown suite (`x-aura::action.dropdown`, `header`, `item`, `separator`).
- Overlay banner, modal, sheet, and toast components.

### Changed
- Reorganized component library into modular directory structure (`action`, `typography`, `form`, `display`, `layout`, `overlay`, `feedback`, `navigation`).
- Refactored icon component structure and integrated Blade Lucide icons.
- Updated form input padding, textarea, select, and button styling logic.

## [1.1.0] - 2026-08-03

### Added
- Installer command (`php artisan aura-wire:install`) to publish config, assets, components, and views.
- Expanded component collection including Progress Bar, Spinner, Pin Code, Sheet/Drawer, Empty State, Tag, Product Card, Breadcrumbs, Banner, Pagination, and File Upload.
- Icon registry integration and enhanced layout containers.
- Comprehensive `README.md` documentation with usage examples and installation guidelines.

### Changed
- Overhauled component library styling and design consistency across all Blade/Livewire components.
- Refactored button and navigation structures for improved developer experience.

## [1.0.0] - 2026-08-03

- Initial release of `insoulit/aura-wire` Laravel UI component package.

