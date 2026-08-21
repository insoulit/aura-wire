# Changelog

All notable changes to `insoulit/aura-wire` will be documented in this file.

## [1.6.1] - 2026-08-21

### Added
- Accordion component enhancements: configurable border (`bordered="false"`), divider lines (`divided="false"`), and size variants (`sm`, `md`, `lg`).
- Card component support for full-width sizing (`size="full"` / `max-w-full`).
- Flex component expanded gap support across all numeric and string tokens with strict string casting.
- Form input width configurations for seamless inline and full-width layouts.

## [1.6.0] - 2026-08-20

### Added
- Animate component (`x-aura::display.animate`) featuring core Tailwind continuous loop animations, micro-interaction hover states, active press feedback, and rotational transforms.
- Grid layout component (`x-aura::layout.grid`) with responsive column breakpoints, individual gap axes (`gapX`, `gapY`), and flex alignments.
- Typography suite additions: Blockquote (`x-aura::typography.blockquote`), Keyboard shortcut (`x-aura::typography.kbd`), Inline code (`x-aura::typography.inline-code`), and Lead (`x-aura::typography.lead`).
- Accordion collapsible dropdown support for sidebar navigation items (`x-aura::sidebar.dropdown`).
- Stack layout and customizable size/gap attributes for container and card components.
- Support for fractional gap utilities (`gap="0.5"`) and flexible width modes (`full`, `auto`, `fit`) in layout components.

### Changed
- Upgraded Popover, Dropdown, and Tooltip floating panels to portal-based `x-teleport="body"` positioning with dynamic viewport bounds calculations.
- Standardized container default max width to `6xl` and normalized inner padding structures.
- Streamlined typography heading sizes and semantic variants while delegating oversized marketing styles to the dedicated `display` component.
- Refactored component padding and border radii logic using structured match expressions across card and container components.
- Enhanced code preview component with automatic dynamic indentation trimming and normalized snippet rendering.
- Added `shrink-0` and `whitespace-nowrap` utilities to badge and tag components for consistent UI layouts.

### Fixed
- Changed default semantic HTML tag for kicker component from `div` to `p`.
- Fixed card footer alignment and code highlighting edge cases.

## [1.5.2] - 2026-08-16

### Added
- Thin scrollbar utility styling (`scrollbar-thin`) to table component wrapper.

### Fixed
- Improved mobile responsiveness, alignment, and spacing for card, footer, and pagination components.

## [1.5.1] - 2026-08-16

### Added
- Dropdown checkbox component (`x-aura::action.dropdown.checkbox`).
- Display typography component (`x-aura::typography.display`) with configurable sizes, weights, and gradient options.
- Configurable link component (`x-aura::typography.link`) with icon support and variant styling.
- Flex, Stack, and Center layout components (`x-aura::layout.flex`, `x-aura::layout.stack`, `x-aura::layout.center`).
- Sortable column support, nowrap, and truncate props for table column, cell, and text components.
- Dynamic sizing support for radio and checkbox components.
- Variant, shape, and container support for icon component.
- Highlighted mode and custom slot support for code component.
- Support for linkable cards and skeleton badge/size variants.

### Changed
- Reorganized component directory structure across data and feedback namespaces.
- Enhanced pagination component with configurable wire actions and responsive styling.
- Standardized action components and modernized stat and progress bar components.

### Fixed
- HTML entity decoding and clipboard copy handling in code component.

## [1.5.0] - 2026-08-11

### Added
- Dedicated layout component suite: Header (`x-aura::header`), Sidebar (`x-aura::sidebar`), Main container (`x-aura::main`), Footer (`x-aura::footer`), and Navbar (`x-aura::navbar`).
- Mobile navigation drawer action slots in `x-aura::header`.

### Changed
- Refactored typography component text colors, spacing, and tracking settings for enhanced dark mode contrast.
- Enforced left-alignment for code display blocks and removed uppercase transformation from code title classes.

## [1.4.0] - 2026-08-11

### Added
- Configurable size variants for `x-aura::subheading`.
- Border radius options and configurable shapes for display components.
- `w-fit` layout utility for badge and tag components to prevent line overflow.

### Changed
- Standardized component border radii across the UI library.
- Renamed `breadcrumbs` component to `breadcrumb` and `tabs` items for semantic naming consistency.

## [1.3.0] - 2026-08-09

### Added
- Advanced UI components: Accordion, Skeleton, Stat, Timeline, Stepper, Combobox, Date Picker, Rating, Command Palette, Popover, and Tooltip.
- Comprehensive feature tests covering typography, actions, forms, display, navigation, and overlay components.
- Inspiration & AI generation attribution notes in documentation.

### Changed
- Refactored component test assertions and feature specifications for component robustness.
- Streamlined `README.md` documentation for concise setup and quick start usage.

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

