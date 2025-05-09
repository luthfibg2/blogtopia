@extends('app')

@section('content')

    <div class="max-w-md w-full bg-day-100 dark:bg-night-100 bg-opacity-50 backdrop-filter backdrop-blur-xl rounded-2xl shadow-xl overflow-hidden">
        <div class="p-8">
            <h2 class="text-3xl font-bold mb-6 text-center bg-gradient-to-r from-steel-400 to-steel-500 text-transparent bg-clip-text">
                Buat Akun
            </h2>
            <form action="{{ route('auth.signup') }}" class="flex flex-col gap-4" method="POST">
                @csrf
                <x-input
                id="name"
                name="name"
                placeholder="Nama Lengkap"
                type="text"
                >
                    <x-slot name="icon">
                        <x-hugeicons-user-03 class="h-6 w-6 text-steel-500" />
                    </x-slot>
                </x-input>

                <x-input
                    id="email"
                    name="email"
                    placeholder="Masukan email"
                    type="email"
                >
                    <x-slot name="icon">
                        <x-hugeicons-mail-02 class="h-6 w-6 text-steel-500" />
                    </x-slot>
                </x-input>
              
                <x-input
                    id="password"
                    name="password"
                    placeholder="Buat password"
                    type="password"
                >
                    <x-slot name="icon">
                        <x-hugeicons-circle-password class="h-6 w-6 text-steel-500" />
                    </x-slot>
                </x-input>

                <x-input
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Konfirmasi password"
                    type="password"
                >
                    <x-slot name="icon">
                        <x-hugeicons-circle-password class="h-6 w-6 text-steel-500" />
                    </x-slot>
                </x-input>

                <x-button type="submit" text="Daftar"/>
            </form>
        </div>
        <div class="px-8 py-4 bg-gray-900 bg-opacity-50 flex justify-center">
          <p class="text-sm text-gray-400">
            Sudah punya akun?&nbsp;
            <a href='{{ route('login') }}' class="font-bold text-steel-700 hover:text-steel-500 hover:underline">Masuk</a>
          </p>
        </div>
    </div>

@endsection