@extends('app')

@section('content')
@props(['category', 'type'])
    <div class="py-12 w-full h-fit">
        <div class="w-full h-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white h-full dark:bg-night-300">
                <div class="p-6 h-full bg-inherit">
                    <form method="POST" class="max-w-xl flex flex-col justify-center h-full mx-auto" action="{{ route('content.store', ['category' => $category, 'type' => $type]) }}">
                        @csrf
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="title" id="floating_title" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label for="floating_title" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Judul Artikel</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group hidden">
                        <input type="hidden" name="slug" id="floating_slug" class="py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" required />
                        <label for="floating_slug" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Judul Artikel</label>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="number" name="read_in_minutes" id="floating_read_in_minutes" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_read_in_minutes" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Menit Baca</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                        <select
                            id="genre"
                            name="genre"
                            required
                            class="peer block py-2.5 px-2 w-full text-sm text-gray-900 bg-night-300 border-0 border-b-2 border-gray-300 appearance-none
                                dark:text-white dark:border-gray-600 dark:bg-night-300 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 rounded-t-md"
                        >
                            <option value="" disabled selected hidden class="text-gray-500 dark:text-gray-400">Pilih Genre</option> <!-- agar label bisa naik -->
                            @foreach ($genres as $genre)
                            <option class="bg-night-200 text-gray-300 px-4 py-2" value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endforeach
                        </select>
                        <label
                            for="genre"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform
                                -translate-y-6 scale-75 top-3 left-2 -z-10 origin-[0] 
                                peer-focus:left-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6
                                peer-focus:text-blue-600 peer-focus:dark:text-blue-500"
                        >
                        </label>
                        </div>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <div class="mb-3 text-gray-200" id="editor" style="font-family: 'Poppins', sans-serif; border-radius: 8px;"></div>
                    </div>
                    <button role="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" required>Posting</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            const quill = new Quill('#editor', {
                theme: 'snow'
            });

            const form = document.querySelector('form');
            form.addEventListener('submit', (e) => {
                // Tambahkan input tersembunyi untuk konten Quill
                const contentInput = document.createElement('input');
                contentInput.setAttribute('type', 'hidden');
                contentInput.setAttribute('name', 'content');
                contentInput.value = quill.root.innerHTML;
                form.appendChild(contentInput);
            });
        });
    </script>
@endsection