@extends('app')

@section('content')

    <div class="flex w-full h-full">
        <x-sidebar-nav :currentCategory="$currentCategory" :currentType="$currentType" />
        <div class="flex-grow flex flex-col items-center justify-center">
            <h1 class="text-5xl text-center font-extrabold tracking-[0.8rem] mb-5 uppercase text-steel-500">blogtopia</h1>
            <h3 class="text-2xl text-center font-bold text-steel-500">
                {{ ucfirst($currentCategory) . ' - ' . ucfirst($currentType) }}
            </h3>
        </div>
        <x-filter-sidebar />
    </div>

@endsection