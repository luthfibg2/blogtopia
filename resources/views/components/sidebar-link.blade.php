@props(['href', 'icon', 'label', 'active' => false, 'disabled' => false])

<li>
    <a href="{{ $disabled ? '#' : $href }}" 
       class="flex gap-1 flex-col items-center p-2 text-base font-normal rounded-lg transition duration-75 
       {{ $active ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }} group
       {{ $disabled ? 'pointer-events-none opacity-50' : '' }}">
        {{ $slot }}
        <span class="text-xs block">{{ $label }}</span>
    </a>
</li>