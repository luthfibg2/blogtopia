@extends('app')

@section('content')
    <div class="p-6 bg-day-100 rounded-lg dark:bg-night-300">
        <h2 class="mb-2 text-2xl font-medium tracking-tight text-gray-900 dark:text-day-300">
            <x-hugeicons-alert-circle class="h-10 w-10 mx-auto text-red-300"/>
            Aplikasi ini tidak bisa diakses setelah {{ $dateString }}
        </h2>
        <p class="text-gray-500 dark:text-gray-400">
            @if(isset($content->content))
                {!! Str::limit($content->content, 100) !!}
            @else
                Konten {{ Str::ucfirst($actualType) }} dalam proses pengembangan.
            @endif
        </p>
    </div>
@endsection