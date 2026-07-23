# AuraWire (`insoulit/aura-wire`)

**AuraWire** is a Blade & Livewire component package for Laravel. It fuses the aesthetics, high-contrast monochrome foundation, and typography of the **Uber Base Design System** with the component architecture of **Flux UI**.

---

## 📚 Citations & Attributions

AuraWire is built upon the foundational design principles and architectural concepts of two open design systems:

1. **[Uber Base Design System](https://base.uber.com/6d2425e9f/p/294ab4-base-design-system)**
   - **Citation**: Uber Technologies, Inc. *Base Design System*. [https://base.uber.com/](https://base.uber.com/6d2425e9f/p/294ab4-base-design-system)
   - **Influence**: Monochrome color foundation, 1px razor-sharp borders, elevated dark mode contrast, status color tokens, and typography scales.

2. **[Flux UI](https://fluxui.dev/docs/installation)**
   - **Citation**: Porzio, Caleb. *Flux UI for Laravel & Livewire*. [https://fluxui.dev/](https://fluxui.dev/docs/installation)
   - **Influence**: Component tag syntax (`<aura:...>`), polymorphic element rendering (`<a>` vs `<button>`), variant/size composition matrices, and Livewire action loading states.

---

## ⚡ Installation

Install the package via Composer:

```bash
composer require insoulit/aura-wire
```

Publish configuration:

```bash
php artisan vendor:publish --tag="aura-wire-config"
```

---

## 🧪 Testing

Run the test suite using Pest:

```bash
composer test
```

---

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
