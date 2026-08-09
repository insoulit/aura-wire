# AuraWire (`insoulit/aura-wire`)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/insoulit/aura-wire.svg?style=flat-square)](https://packagist.org/packages/insoulit/aura-wire)
[![Total Downloads](https://img.shields.io/packagist/dt/insoulit/aura-wire.svg?style=flat-square)](https://packagist.org/packages/insoulit/aura-wire)
[![License](https://img.shields.io/packagist/l/insoulit/aura-wire.svg?style=flat-square)](LICENSE.md)

**AuraWire** is a sleek, modern Blade & Livewire component suite for Laravel. It fuses the high-contrast monochrome aesthetics, 1px razor-sharp borders, and typography of the **Uber Base Design System** with the component architecture and tag syntax of **Flux UI**.

🌐 **Live Documentation & Demo Site**: [https://aura-wire.insoulit.com/](https://aura-wire.insoulit.com/)

---

## ✨ Features

- 🎨 **Uber Base Design Aesthetics**: Monochrome color foundation, elevated dark mode contrast, status color tokens, and clean typography.
- ⚡ **Dual Tag Syntax**: Full support for shorthand `<aura:...>` tag syntax as well as standard `<x-aura::...>` Blade component syntax.
- 🧩 **30+ Blade & Livewire Components**: Complete suite spanning Typography, Form Controls, Actions, Display, Navigation, Layouts, and Overlays.
- 🌓 **First-Class Dark Mode**: Automatic theme switcher support (`class` or `media` strategies) with high dark-mode contrast ratios.
- 🚀 **Pre-built Layout Portals**: Turnkey layouts for Guest Portals, User Workspaces, and Admin Consoles.
- 🛠️ **Configurable Prefix & Theme**: Customize component namespace prefixes and global theme tokens in `config/aura-wire.php`.

---

## ⚡ Installation

Install the package via Composer:

```bash
composer require insoulit/aura-wire
```

Publish the configuration file:

```bash
php artisan vendor:publish --tag="aura-wire-config"
```

*(Optional)* Publish Blade views for custom styling modifications:

```bash
php artisan vendor:publish --tag="aura-wire-views"
```

---

## ⚙️ Configuration

The published configuration file is located at `config/aura-wire.php`:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | AuraWire Component Prefix
    |--------------------------------------------------------------------------
    |
    | Sets the prefix for Blade components registered by AuraWire.
    | Available via <aura:button> or <x-aura::button>.
    |
    */
    'prefix' => 'aura',

    /*
    |--------------------------------------------------------------------------
    | Theme & Styling Options
    |--------------------------------------------------------------------------
    */
    'theme' => [
        'border_radius' => 'md', // 'none' | 'sm' | 'md' | 'lg' | 'full'
        'dark_mode' => 'class', // 'class' | 'media'
        'accent_color' => 'blue', // 'blue' | 'black' | 'indigo'
    ],
];
```

---

## 📦 Component Suite

AuraWire provides over 30 UI components organized into 7 functional categories:

### 1. 🔤 Typography
| Component | Syntax | Description |
| :--- | :--- | :--- |
| **Heading** | `<aura:heading level="1" size="display-lg">` | Section titles with configurable levels (h1-h6) and sizes (`display-lg`, `xl`, `lg`, `md`, `sm`). |
| **Subheading** | `<aura:subheading>` | Descriptive subtext styled under main headers. |
| **Kicker** | `<aura:kicker>` | Uppercase eyebrow/category labels. |
| **Text** | `<aura:text variant="subtle" size="sm">` | Body text with variant and weight options. |

### 2. ⚡ Actions
| Component | Syntax | Description |
| :--- | :--- | :--- |
| **Button** | `<aura:button variant="primary" size="md">` | Polymorphic button (`<button>` or `<a>`) with loading & icon states. |
| **Button Group** | `<aura:button-group>` | Segmented or connected button groups. |
| **Dropdown** | `<aura:dropdown>` | Contextual popup menus and options. |

### 3. 📝 Form Controls
| Component | Syntax | Description |
| :--- | :--- | :--- |
| **Input** | `<aura:input type="email" label="Email">` | Standard & floating text input fields. |
| **Textarea** | `<aura:textarea rows="4">` | Multi-line text input areas. |
| **Select** | `<aura:select :options="$options">` | Custom styled select dropdowns. |
| **Combobox** | `<aura:combobox :options="$options">` | Searchable filter select dropdown with live search. |
| **DatePicker** | `<aura:date-picker name="dob">` | Interactive calendar date selection control. |
| **Rating** | `<aura:rating rating="4">` | Interactive & display star rating control. |
| **Checkbox** | `<aura:checkbox label="Remember me">` | Single and grouped checkboxes. |
| **Radio** | `<aura:radio name="plan">` | Radio selection controls. |
| **Switch** | `<aura:switch label="Notifications">` | Toggle switch controls. |
| **Field & Label** | `<aura:field>` / `<aura:label>` | Form field wrappers with label and error binding. |
| **Error** | `<aura:error name="email">` | Field validation error message displays. |
| **File Upload** | `<aura:file-upload>` | Drag-and-drop or single file inputs. |
| **PIN Code** | `<aura:pin-code length="6">` | Multi-digit verification & OTP input field. |

### 4. 📊 Data Display
| Component | Syntax | Description |
| :--- | :--- | :--- |
| **Accordion** | `<aura:accordion>` | Expandable vertical accordion group with single/multiple modes. |
| **Avatar** | `<aura:avatar src="..." name="User">` | User avatar images and initials fallback. |
| **Badge** | `<aura:badge variant="positive">` | Status indicators and tag badges (`neutral`, `positive`, `negative`, `warning`). |
| **Card** | `<aura:card>` | Container card with header, body, and footer slots. |
| **Code** | `<aura:code language="php">` | Formatted inline and block code blocks. |
| **Empty State** | `<aura:empty-state title="No items">` | Visual placeholder for empty data sets. |
| **Numbered List** | `<aura:numbered-list>` | Step-by-step ordered list layout. |
| **Product Card** | `<aura:product-card>` | Specialized layout for e-commerce or item showcases. |
| **Progress Bar** | `<aura:progress-bar value="75">` | Visual progress indicator bars. |
| **Separator** | `<aura:separator>` | Horizontal and vertical divider lines. |
| **Skeleton** | `<aura:skeleton variant="avatar">` | Pulsing animated loading placeholders for text, avatars, buttons, and cards. |
| **Stat Card** | `<aura:stat label="Revenue" value="$48k">` | KPI metric display card with trend badges and icons. |
| **Table** | `<aura:table>` | Structured data table grid. |
| **Tabs** | `<aura:tabs>` | Tabbed content switching layout. |
| **Timeline** | `<aura:timeline>` | Chronological event & activity history tracker. |

### 5. 🧭 Navigation
| Component | Syntax | Description |
| :--- | :--- | :--- |
| **Breadcrumbs** | `<aura:breadcrumbs>` | Hierarchical path navigation links. |
| **Pagination** | `<aura:pagination :paginator="$items">` | Page controls for data sets. |
| **Stepper** | `<aura:stepper active="2">` | Step-by-step workflow progress tracker. |

### 6. 🏗️ Layout & Structural
| Component | Syntax | Description |
| :--- | :--- | :--- |
| **Header** | `<aura:header>` | Page header bar with title and action slots. |
| **Sidebar** | `<aura:sidebar>` | Collapsible navigation sidebar. |
| **Main** | `<aura:main>` | Main content area wrapper. |
| **Navbar** | `<aura:navbar>` | Top navigation toolbar. |
| **Footer** | `<aura:footer>` | Global site and application footer. |

### 7. 💬 Overlays & Feedback
| Component | Syntax | Description |
| :--- | :--- | :--- |
| **Banner** | `<aura:banner variant="warning">` | Alert and notification banner strips. |
| **Command Palette** | `<aura:command key="k">` | `Cmd+K` / `Ctrl+K` keyboard-driven modal search palette. |
| **Modal** | `<aura:modal id="confirm">` | Pop-up dialog modals with focus trapping. |
| **Popover** | `<aura:popover>` | Floating content popover panel. |
| **Sheet Drawer** | `<aura:sheet side="right">` | Slide-over drawer panels. |
| **Spinner** | `<aura:spinner size="sm">` | Loading indicator spinners. |
| **Tag** | `<aura:tag>` | Categorization chips and removable tags. |
| **Toast** | `<aura:toast>` | Temporary feedback notification popups. |
| **Tooltip** | `<aura:tooltip text="...">` | Hover & focus tooltip with placement options. |

---

## 🚀 Quick Usage Example

```html
<x-aura::card>
    <x-aura::header>
        <x-aura::kicker>User Settings</x-aura::kicker>
        <x-aura::heading level="2">Account Details</x-aura::heading>
    </x-aura::header>

    <div class="space-y-4 my-4">
        <x-aura::input label="Full Name" name="name" value="Jane Doe" />
        <x-aura::input label="Email Address" type="email" name="email" value="jane@example.com" />
    </div>

    <x-slot:footer>
        <div class="flex justify-end gap-2">
            <x-aura::button variant="secondary">Cancel</x-aura::button>
            <x-aura::button variant="primary">Save Changes</x-aura::button>
        </div>
    </x-slot:footer>
</x-aura::card>
```

You can also use shorthand tag syntax:

```html
<aura:card>
    <aura:heading level="2">Account Details</aura:heading>
    <aura:button variant="primary">Save</aura:button>
</aura:card>
```

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

## 🧪 Testing & Quality Assurance

Run the test suite using Pest:

```bash
composer test
```

Run static analysis with PHPStan:

```bash
composer analyse
```

Format code using Laravel Pint:

```bash
composer format
```

---

## 🌐 Community & Documentation

Explore the interactive documentation, layout showcases, and live component directory at:
👉 **[https://aura-wire.insoulit.com/](https://aura-wire.insoulit.com/)**

---

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
