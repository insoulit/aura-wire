@props([
    'name' => null,
    'value' => null,
    'label' => null,
    'placeholder' => 'Select date...',
    'format' => 'MMMM D, YYYY', // e.g. 'MMMM D, YYYY' (May 4, 2026), 'MMM D, YYYY', 'DD-MM-YYYY', 'DD/MM/YYYY'
])

@php
    $wireModel = $attributes->wire('model');
    $hasWireModel = $attributes->has('wire:model') && isset($__livewire);
@endphp

<div
    x-data="{
        open: false,
        selectedDate: @if($hasWireModel) @entangle($wireModel) @else {{ json_encode($value) }} @endif,
        format: {{ json_encode($format) }},
        currentYear: new Date().getFullYear(),
        currentMonth: new Date().getMonth(),
        shortMonths: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        fullMonths: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        init() {
            if (this.selectedDate) {
                const parts = String(this.selectedDate).split('-');
                if (parts.length === 3) {
                    const y = parseInt(parts[0], 10);
                    const m = parseInt(parts[1], 10);
                    if (!isNaN(y) && !isNaN(m) && m >= 1 && m <= 12) {
                        this.currentYear = y;
                        this.currentMonth = m - 1;
                    }
                }
            }
        },
        daysInMonth() {
            return new Date(this.currentYear, this.currentMonth + 1, 0).getDate();
        },
        firstDayOfMonth() {
            return new Date(this.currentYear, this.currentMonth, 1).getDay();
        },
        formatDate(isoString) {
            if (!isoString) return '';
            const parts = String(isoString).split('-');
            if (parts.length !== 3) return isoString;
            const year = parts[0];
            const month = parseInt(parts[1], 10);
            const day = parseInt(parts[2], 10);
            if (isNaN(month) || isNaN(day)) return isoString;

            const padM = String(month).padStart(2, '0');
            const padD = String(day).padStart(2, '0');
            const shortMonthName = this.shortMonths[month - 1] || '';
            const fullMonthName = this.fullMonths[month - 1] || '';

            return this.format
                .replace('YYYY', year)
                .replace('MMMM', fullMonthName)
                .replace('MMM', shortMonthName)
                .replace('MM', padM)
                .replace('DD', padD)
                .replace(/\bM\b/, month)
                .replace(/\bD\b/, day);
        },
        get displayValue() {
            return this.formatDate(this.selectedDate);
        },
        selectDate(day) {
            const m = String(this.currentMonth + 1).padStart(2, '0');
            const d = String(day).padStart(2, '0');
            this.selectedDate = `${this.currentYear}-${m}-${d}`;
            this.open = false;
            if (this.$refs.hiddenInput) {
                this.$refs.hiddenInput.value = this.selectedDate;
                this.$refs.hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
            }
        },
        prevMonth() {
            if (this.currentMonth === 0) {
                this.currentMonth = 11;
                this.currentYear--;
            } else {
                this.currentMonth--;
            }
        },
        nextMonth() {
            if (this.currentMonth === 11) {
                this.currentMonth = 0;
                this.currentYear++;
            } else {
                this.currentMonth++;
            }
        }
    }"
    @click.outside="open = false"
    :class="open ? 'relative w-full space-y-1 z-30' : 'relative w-full space-y-1 z-0'"
>
    @if ($label)
        <x-aura::label>{{ $label }}</x-aura::label>
    @endif

    @if ($name)
        <input ref="hiddenInput" type="hidden" name="{{ $name }}" :value="selectedDate" />
    @endif

    <button
        type="button"
        @click="open = !open"
        class="w-full bg-zinc-50 dark:bg-zinc-900/90 text-zinc-900 dark:text-white border border-zinc-300 dark:border-zinc-700 rounded-lg p-3 text-sm text-left flex items-center justify-between shadow-2xs outline-none focus:border-zinc-900 dark:focus:border-zinc-100 cursor-pointer"
    >
        <span x-text="displayValue || '{{ $placeholder }}'" :class="{ 'text-zinc-400': !displayValue }"></span>
        <svg class="w-4 h-4 text-zinc-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
    </button>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute left-0 z-50 mt-1 p-3 w-64 rounded-xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 shadow-xl space-y-3"
        style="display: none;"
    >
        {{-- Header Month Nav --}}
        <div class="flex items-center justify-between text-xs font-bold text-zinc-900 dark:text-white">
            <button type="button" @click="prevMonth()" class="p-1 rounded-md hover:bg-zinc-100 dark:hover:bg-zinc-800 cursor-pointer">&larr;</button>
            <span x-text="fullMonths[currentMonth] + ' ' + currentYear"></span>
            <button type="button" @click="nextMonth()" class="p-1 rounded-md hover:bg-zinc-100 dark:hover:bg-zinc-800 cursor-pointer">&rarr;</button>
        </div>

        {{-- Calendar Grid --}}
        <div class="grid grid-cols-7 gap-1 text-center text-[10px] font-semibold text-zinc-400">
            <div>Su</div><div>Mo</div><div>Tu</div><div>We</div><div>Th</div><div>Fr</div><div>Sa</div>
        </div>

        <div class="grid grid-cols-7 gap-1 text-center">
            <template x-for="blank in firstDayOfMonth()" :key="'b'+blank">
                <div class="h-7 w-7"></div>
            </template>
            <template x-for="day in daysInMonth()" :key="day">
                <button
                    type="button"
                    @click="selectDate(day)"
                    class="h-7 w-7 mx-auto text-xs font-semibold rounded-full flex items-center justify-center transition-colors cursor-pointer"
                    :class="selectedDate === `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`
                        ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 font-bold shadow-2xs'
                        : 'text-zinc-800 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-800'"
                    x-text="day"
                ></button>
            </template>
        </div>
    </div>
</div>
