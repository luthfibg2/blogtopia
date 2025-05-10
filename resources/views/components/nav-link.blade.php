@props(['href', 'active' => false])

<li>
    <a href="{{ $href }}" 
       class="{{ $active ? 'font-semibold text-steel-500 dark:text-steel-400' : 'text-gray-700 dark:text-day-300 hover:text-steel-500 dark:hover:text-steel-400' }}">
        {{ $slot }}
    </a>
</li>