<div class="py-4 px-4 mx-auto max-w-screen-xl lg:w-[60%] lg:py-6 lg:px-6">
    <div class="mx-auto max-w-screen-xl sm:text-center">
        <form>
            @if (request('genre'))
                <input type="hidden" name="genre" value="{{ request('genre') }}"/>
            @endif
            <div class="items-center mx-auto space-y-4 max-w-screen-xl sm:flex sm:space-y-0">
                <div class="relative w-full">
                    <label for="search" class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cari Blog</label>
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 w-5 h-5 text-gray-500 dark:text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input class="block p-3 pl-10 w-full bg-white text-sm text-gray-900 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-steel-500 focus:border-steel-500 dark:bg-night-200 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-steel-500 dark:focus:border-steel-500" placeholder="{{ $slot }}" type="search" name="search" autocomplete="off" required="">
                </div>
                <div>
                    <button type="submit" class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-steel-500 border-steel-600 sm:rounded-none sm:rounded-r-lg hover:bg-steel-800 focus:ring-4 focus:ring-steel-300 dark:bg-steel-600 dark:hover:bg-steel-700 dark:focus:ring-steel-800">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>