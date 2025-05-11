@props(['type' => 'a', 'href' => '#'])

<{{ $type }} href="{{ $href }}" class="py-3 h-fit flex gap-2 px-6 bg-gradient-to-r from-steel-500 to-steel-800 text-white rounded-lg shadow-lg hover:from-steel-600 hover:to-steel-900 focus:outline-none focus:ring-2 focus:ring-steel-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition duration-200">
    {{ $slot }}
</{{ $type }}>