# AuraWire (`insoulit/aura-wire`)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/insoulit/aura-wire.svg?style=flat-square)](https://packagist.org/packages/insoulit/aura-wire)
[![Total Downloads](https://img.shields.io/packagist/dt/insoulit/aura-wire.svg?style=flat-square)](https://packagist.org/packages/insoulit/aura-wire)
[![License](https://img.shields.io/packagist/l/insoulit/aura-wire.svg?style=flat-square)](LICENSE.md)

**AuraWire** is a clean, beautiful, and accessible Blade & Livewire component library for Laravel applications.

🌐 **Live Documentation & Demo Site**: [https://aura-wire.insoulit.com/](https://aura-wire.insoulit.com/)

---

## ⚡ Quick Start

### 1. Installation

Install via Composer:

```bash
composer require insoulit/aura-wire
```

Publish configuration:

```bash
php artisan vendor:publish --tag="aura-wire-config"
```

### 2. Usage

```html
<x-aura::button variant="primary">Save Changes</x-aura::button>
```

Shorthand tag syntax:

```html
<aura:button variant="primary">Save Changes</aura:button>
```

---

## 🧩 Component Index (30+ Components)

| Category | Components |
| :--- | :--- |
| **Typography** | `heading`, `subheading`, `kicker`, `text` |
| **Actions** | `button`, `button-group`, `dropdown`, `icon-button` |
| **Form Controls** | `input`, `select`, `textarea`, `checkbox`, `radio`, `switch`, `combobox`, `date-picker`, `rating`, `rich-text`, `file-upload`, `pin-code`, `field`, `label`, `error` |
| **Data Display** | `accordion`, `avatar`, `badge`, `card`, `code`, `empty-state`, `list`, `numbered-list`, `product-card`, `progress-bar`, `separator`, `skeleton`, `stat`, `table`, `tabs`, `tag`, `timeline` |
| **Navigation** | `breadcrumbs`, `header`, `navbar`, `pagination`, `sidebar`, `stepper` |
| **Overlays & Feedback** | `alert`, `banner`, `command`, `modal`, `popover`, `sheet`, `spinner`, `toast`, `tooltip` |

---

## 🧪 Testing

Run the test suite:

```bash
composer test
```

---

## 💡 Inspiration & AI Generation

**AuraWire** drew design inspiration from [Livewire Flux](https://fluxui.dev/) and Uber's [Base Design System](https://baseweb.design/).

This entire package was created completely using AI.

---

## 📄 License

The MIT License (MIT). See [License File](LICENSE.md) for details.
