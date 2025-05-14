@props([
    'content' => null, 
    'category', 
    'type', 
    'slug' => null
])

@php
    // Jika content tidak ada (empty state), tampilkan card kosong
    if (!$content) {
        $actualType = $type;
    } else {
        $actualType = $type === 'latest' ? strtolower(class_basename($content)) : $type;
        $readRoute = route('content.read', [
            'category' => $category,
            'type' => $actualType,
            'slug' => $content->slug
        ]);
        $editContent = route('content.edit', [
            'category' => $category,
            'type' => $actualType,
            'slug' => $content->slug
        ]);
    }
@endphp

@if(!$content)
    <!-- Tampilan untuk empty state -->
    <div class="p-6 bg-day-100 rounded-lg dark:bg-night-300">
        <h2 class="mb-2 text-2xl font-medium tracking-tight text-gray-900 dark:text-day-300">
            <x-hugeicons-alert-02 class="h-10 w-10 mx-auto text-yellow-300"/>
            Tidak Ada Konten
        </h2>
        <p class="text-gray-500 dark:text-gray-400">
            Tidak ditemukan konten untuk kategori ini.
        </p>
    </div>
@else
    @switch($actualType)
        @case('short')
            <article class="flex flex-col p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-night-100 dark:border-gray-700">
                <div class="flex flex-1/10 justify-between items-center mb-5 text-gray-500">
                    <span class="bg-steel-100 text-steel-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-steel-200 dark:text-steel-800">
                        <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path></svg>
                        {{ $content->genre->name ?? 'Short' }}
                    </span>
                    <span class="text-sm">{{ $content->created_at->diffForHumans() }}</span>
                </div>
                <h2 class="mb-2 flex-1/10 text-2xl font-bold tracking-tight text-night-200 dark:text-day-300"><a href="#">{{ $content->title }}</a></h2>
                <div class="flex items-center font-light text-gray-500 flex-6/10 dark:text-gray-400">
                {!! 
                    Str::of($content->content)
                        ->limit(100)
                        ->pipe(function ($content) {
                            return '<p class="text-night-200  dark:text-day-300">' . $content . '</p>';
                        })
                !!}
                </div>
                <div class="flex flex-2/10 justify-between mt-5 items-center">
                    <div class="flex items-center">
                        @if ($category === 'private')
                        <a href="{{ $editContent }}" class="btn cursor-pointer">
                            <div class="w-fit h-fit p-2 rounded-full bg-night-300">
                                {{ $editIcon }}
                            </div>
                        </a>
                        @else
                            <img class="w-7 h-7 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Jese Leos avatar" />
                            <span class="font-medium ms-4 dark:text-white">
                                {{ $content->author->name }}
                            </span>
                        @endif
                    </div>
                    <a href="{{ $readRoute }}" class="inline-flex items-center font-medium text-steel-600 dark:text-steel-500 hover:underline">
                        Read more
                        <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
            </article> 
            @break
        @case('flash')
            <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-night-100 dark:border-gray-700">
                <h2 class="mb-2 text-2xl font-bold tracking-tight text-night-200 dark:text-day-300">{{ $content->title }}</h2>
                <!-- Tambahkan elemen lain untuk flash -->
            </article>
            @break
            
        @case('series')
        @case('lyric')
        @case('mech')
        @case('refs')
            <div class="p-6 bg-day-100 rounded-lg dark:bg-night-300">
                <h2 class="mb-2 text-2xl font-medium tracking-tight text-gray-900 dark:text-day-300">
                    <x-hugeicons-alert-02 class="h-10 w-10 mx-auto text-yellow-300"/>
                    {{ $content->title ?? ('Konten ' . Str::ucfirst($actualType)) }}
                </h2>
                <p class="text-gray-500 dark:text-gray-400">
                    @if(isset($content->content))
                        {!! Str::limit($content->content, 100) !!}
                    @else
                        Konten {{ Str::ucfirst($actualType) }} dalam proses pengembangan.
                    @endif
                </p>
            </div>
            @break  
        @default
            <div class="p-6 bg-day-300 rounded-lg border border-gray-200 shadow-md dark:bg-night-100 dark:border-gray-700">
                <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-day-300">
                    {{ $content->title ?? 'Tipe Konten Tidak Dikenal' }}
                </h2>
                <p class="text-gray-500 dark:text-gray-400">
                    @if(isset($content->content))
                        {!! Str::limit($content->content, 100) !!}
                    @else
                        Maaf, tipe konten yang Anda minta tidak tersedia.
                    @endif
                </p>
            </div>
    @endswitch
@endif