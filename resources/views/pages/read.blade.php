@extends('app')

@section('content')
    <div class="flex w-full h-full">
        <x-sidebar-nav :currentCategory="$currentCategory" :currentType="$currentType" />
        <div class="flex-grow flex flex-col ml-20 mr-38 py-20 items-center justify-center">
            <div class="flex flex-1/5 w-full px-5 items-start">
                @auth
                    <x-breadcrumbs 
                        :currentCategory="$currentCategory" 
                        :currentType="$currentType" 
                        :slug="$content->slug" 
                    />
                @endauth
            </div>
            <div class="flex flex-4/5 flex-col items-center justify-center px-5 w-full max-w-4xl">
                <article class="w-full p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-night-100 dark:border-gray-700">
                    <h1 class="mb-4 text-3xl font-bold tracking-tight text-night-200 dark:text-day-300">
                        {{ $content->title }}
                    </h1>
                    <div class="flex justify-between items-center mb-6 text-gray-500">
                        <span class="flex items-center">
                            <img class="w-8 h-8 rounded-full mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Author avatar">
                            {{ $content->author->name }}
                        </span>
                        <span class="text-sm">
                            {{ $content->created_at->format('d M Y') }}
                        </span>
                    </div>
                    <div class="prose max-w-none dark:prose-invert">
                        {!! 
                            Str::of($content->content)
                            ->pipe(function ($content) {
                                return '<div class="text-night-200 dark:text-day-300">' . $content . '</div>';
                            }) 
                        !!}
                    </div>
                </article>
            </div>
        </div>
        <x-filter-sidebar />
    </div>
@endsection