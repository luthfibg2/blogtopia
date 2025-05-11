<aside id="filter-sidebar" class="fixed top-0 right-0 z-40 w-38 pt-12 h-full shrink-0 transition-transform translate-x-full sm:translate-x-0" aria-label="Sidebar">
  <div class="overflow-y-auto py-5 px-4 h-full bg-white border-l border-gray-200 dark:bg-night-300 dark:border-gray-700">
    
    {{-- Sorting Section --}}
    <div class="mb-6">
      <h3 class="text-sm font-semibold text-gray-500 uppercase dark:text-steel-500 mb-2">Urutkan</h3>
      <ul class="space-y-2 text-sm text-gray-900 dark:text-gray-100">
        <li>
          {{-- <a href="{{ route('content.sort', ['sort' => 'latest']) }}"
             class="flex items-center px-2 py-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700 {{ request('sort') === 'latest' ? 'font-semibold text-primary-600' : '' }}">
            Terbaru
          </a> --}}
          <a href="#"
             class="flex items-center px-2 py-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
            Terbaru
          </a>
        </li>
        <li>
          {{-- <a href="{{ route('content.sort', ['sort' => 'popular']) }}"
             class="flex items-center px-2 py-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700 {{ request('sort') === 'popular' ? 'font-semibold text-primary-600' : '' }}">
            Terpopuler
          </a> --}}
          <a href="#"
             class="flex items-center px-2 py-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
            Terpopuler
          </a>
        </li>
        <li>
          {{-- <a href="{{ route('content.sort', ['sort' => 'oldest']) }}"
             class="flex items-center px-2 py-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700 {{ request('sort') === 'oldest' ? 'font-semibold text-primary-600' : '' }}">
            Terdahulu
          </a> --}}
          <a href="#"
             class="flex items-center px-2 py-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
            Terdahulu
          </a>
        </li>
      </ul>
    </div>

    {{-- Filter by Reading Time --}}
    <div class="mb-6">
      <h3 class="text-sm font-semibold text-gray-500 uppercase dark:text-steel-500 mb-2">Waktu Baca</h3>
      <ul class="space-y-2 text-sm">
        @foreach(['1-5' => '1 - 5 menit', '5-10' => '5 - 10 menit', '10+' => '10+ menit'] as $key => $label)
        <li class="flex items-center">
          <input id="read-{{ $key }}" type="checkbox" value="{{ $key }}"
            class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:bg-gray-600 dark:border-gray-500" />
          <label for="read-{{ $key }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
            {{ $label }}
          </label>
        </li>
        @endforeach
      </ul>
    </div>

    {{-- Filter by Category Type --}}
    <div>
      <h3 class="text-sm font-semibold text-gray-500 uppercase dark:text-steel-500 mb-2">Tipe Cerita</h3>
      <ul class="space-y-2 text-sm">
        @foreach(['fabel', 'anak-anak', 'remaja', 'romansa', 'aksi', 'sci-fi', 'fantasi'] as $genre)
        <li class="flex items-center">
          <input id="genre-{{ $genre }}" type="checkbox" value="{{ $genre }}"
            class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:bg-gray-600 dark:border-gray-500" />
          <label for="genre-{{ $genre }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
            {{ ucfirst($genre) }}
          </label>
        </li>
        @endforeach
      </ul>
    </div>

  </div>
</aside>
