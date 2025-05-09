<div class="relative">
    @if ($label)
        <label for="{{ $id }}" class="text-gray-600">{{ $label }}</label>
    @endif

    <!-- Tambahkan focus-within -->
    <div class="flex items-center w-full px-3 bg-day-300 dark:bg-night-300 bg-opacity-50 rounded-lg border border-day-500 dark:border-night-500 focus-within:ring-1 focus-within:ring-steel-500 focus-within:border-steel-500 transition duration-200">

        @isset($icon)
            {{ $icon }}
        @endif

        <input
            id="{{ $id }}"
            name="{{ $name }}"
            type="{{ $type }}"
            placeholder="{{ $placeholder }}"
            value="{{ old($name, $value) }}"
            autocomplete="off"
            class="w-full bg-transparent border-none outline-none focus:ring-0 focus:border-none text-gray-800 dark:text-gray-200 placeholder-gray-600 dark:placeholder-gray-500 transition duration-200"
        />
    </div>
</div>
