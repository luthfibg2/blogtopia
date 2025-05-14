@extends('app')

@section('content')

    <div class="flex w-full h-full">
        <x-sidebar-nav :currentCategory="$currentCategory" :currentType="$currentType" />
        <div class="flex-grow flex flex-col ml-20 mr-38 pt-12 items-center justify-center">
            <div class="flex flex-1/5 w-full px-5 items-center">
                @auth
                    <x-breadcrumbs :currentCategory="$currentCategory" :currentType="$currentType" />
                @endauth
                <x-searchbar>
                    Cari...
                </x-searchbar>
                @auth    
                    <x-button2 href="{{ route('content.create', ['category' => $currentCategory, 'type' => $currentType]) }}">
                        <x-hugeicons-plus-sign-circle class="h-6 w-6 text-white"/>
                        @if ($currentType === 'flash')
                            Buat Flash
                        @elseif ($currentType === 'lyric')
                            Buat Lirik
                        @elseif ($currentType === 'mech')
                            Buat Mekanik
                        @else
                            Buat Artikel
                        @endif
                    </x-button2>
                @endauth
            </div>
            <div class="flex flex-4/5 flex-col items-center pb-5 justify-center px-5">
                <div class="grid gap-5 lg:grid-cols-3">
                    @if ($currentCategory === 'private')
                        @forelse($myContents as $content)
                            <x-post-card 
                                :content="$content" 
                                :category="$currentCategory" 
                                :type="$currentType" 
                                :slug="$content->slug ?? ''" 
                            >
                                <x-slot name="editIcon">
                                    <x-hugeicons-edit-02 class="w-6 h-6 text-steel-500"/>
                                </x-slot>
                            </x-post-card>
                        @empty
                            <div class="col-span-full text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-night-300 dark:border-gray-500">
                                <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-day-400">
                                    Tidak Ada Konten
                                </h2>
                                <!-- Panggil post-card tanpa content untuk empty state -->
                                <x-post-card 
                                    :category="$currentCategory" 
                                    :type="$currentType"
                                />
                            </div>
                        @endforelse
                    @elseif ($currentCategory === 'all')
                        @forelse($contents as $content)
                            <x-post-card 
                                :content="$content" 
                                :category="$currentCategory" 
                                :type="$currentType" 
                                :slug="$content->slug ?? ''" 
                            />
                        @empty
                            <div class="col-span-full text-center p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-night-300 dark:border-gray-500">
                                <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-day-400">
                                    Tidak Ada Konten
                                </h2>
                                <!-- Panggil post-card tanpa content untuk empty state -->
                                <x-post-card 
                                    :category="$currentCategory" 
                                    :type="$currentType"
                                />
                            </div>
                        @endforelse
                    @endif
                </div>
            </div>
        </div>
        <x-filter-sidebar />
    </div>

@endsection