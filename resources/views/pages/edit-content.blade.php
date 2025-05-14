@extends('app')

@push('create_post')
    <script src="{{ asset('./upload_image.js') }}"></script>
@endpush

@section('content')
@props(['category', 'type'])
    <h1 class="text-center">Edit Flash</h1>
    <div class="py-12 w-full h-fit">
        <div class="w-full h-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white h-full dark:bg-night-300">
                <div class="p-6 h-full bg-inherit">
                    <form method="POST" class="max-w-xl flex flex-col justify-center h-full mx-auto" action="{{ route('content.store', ['category' => $category, 'type' => $type]) }}">
                        @csrf
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="title" id="floating_title" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_title" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Judul 
                            @if ($type == 'flash')
                                Flash
                            @elseif ($type == 'lyric')
                                Lyric
                            @elseif ($type == 'mech')
                                Mekanik
                            @else
                                Artikel
                            @endif
                            </label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group hidden">
                            <input type="hidden" name="slug" id="floating_slug" class="py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" required />
                            <label for="floating_slug" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Judul Artikel</label>
                        </div>
                        @if ($type == 'flash')    
                            <div class="relative z-0 w-full mb-5 group">
                                <textarea name="description" id="floating_desc" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required>
                                    {{ $flash->description }}
                                </textarea>
                                <label for="floating_desc" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] left-0 rtl:peer-focus:translate-x-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Deskripsi</label>
                            </div>
                            <!-- Image Picker Area -->
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="file" id="image-upload" name="image" accept="image/*" class="hidden" />
                                <label for="image-upload" class="flex flex-col items-center justify-center w-full h-45 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-night-200 hover:bg-gray-100 dark:border-steel-500 dark:hover:border-steel-400 dark:hover:bg-night-400">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk upload</span> atau seret dan lepas</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG (MAX. 5MB)</p>
                                    </div>
                                    <div id="file-name" class="text-sm text-gray-500 dark:text-gray-400 pb-2 hidden"></div>
                                </label>
                            </div>
                        @endif
                        @if ($type == 'short' || $type == 'series')                            
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
                        @endif
                        <button role="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" required>Simpan Perubahan</button>
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