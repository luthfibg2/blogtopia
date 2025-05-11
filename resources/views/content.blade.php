@extends('app')

@section('content')

    <div class="flex w-full h-full">
        <x-sidebar-nav :currentCategory="$currentCategory" :currentType="$currentType" />
        <div class="flex-grow flex flex-col ml-20 mr-38 pt-12 items-center justify-center">
            <div class="flex flex-1/5 w-full px-5 items-center">
                <x-breadcrumbs :currentCategory="$currentCategory" :currentType="$currentType" />
                <x-searchbar>
                    Cari...
                </x-searchbar>
                <x-button2>
                    <x-hugeicons-plus-sign-circle class="h-6 w-6 text-white"/>
                    Blog Baru
                </x-button2>
            </div>
            <div class="flex flex-4/5 flex-col items-center justify-center px-5">
                <div class="grid gap-5 lg:grid-cols-3">
                    <x-post-card></x-post-card>
                    <x-post-card></x-post-card>
                    <x-post-card></x-post-card>
                    <x-post-card></x-post-card>
                    <x-post-card></x-post-card>
                    <x-post-card></x-post-card>
                    <x-post-card></x-post-card>
                    <x-post-card></x-post-card>
                    <x-post-card></x-post-card>
                </div>
            </div>
        </div>
        <x-filter-sidebar />
    </div>

@endsection