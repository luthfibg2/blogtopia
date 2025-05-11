@props(['currentCategory' => 'all', 'currentType' => 'latest'])

<aside id="default-sidebar" class="fixed top-0 left-0 z-40 pt-12 md:w-20 h-full shrink-0 transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidenav">
   <div class="overflow-y-auto py-5 px-3 h-full bg-white border-r border-gray-200 dark:bg-night-300 dark:border-gray-700">
       <ul class="space-y-2">
           <x-sidebar-link 
               href="{{ route('content.type', ['category' => $currentCategory, 'type' => 'latest']) }}"
               :active="$currentType === 'latest'"
               :disabled="$currentCategory === 'favorite'"
               label="Latest">
               <x-hugeicons-new-releases class="h-6 w-6 text-steel-500"/>
           </x-sidebar-link>
       </ul>
       <ul class="pt-2 mt-2 space-y-0 border-t border-gray-200 dark:border-gray-700">
           <x-sidebar-link 
               href="{{ route('content.type', ['category' => $currentCategory, 'type' => 'flash']) }}"
               :active="$currentType === 'flash'"
               :disabled="$currentCategory === 'favorite'"
               label="Flash">
               <x-hugeicons-rocket-01 class="h-6 w-6 text-steel-500"/>
           </x-sidebar-link>
           
           <x-sidebar-link 
               href="{{ route('content.type', ['category' => $currentCategory, 'type' => 'short']) }}"
               :active="$currentType === 'short'"
               :disabled="false"
               label="Short">
               <x-hugeicons-news class="h-6 w-6 text-steel-500"/>
           </x-sidebar-link>
           
           <x-sidebar-link 
               href="{{ route('content.type', ['category' => $currentCategory, 'type' => 'series']) }}"
               :active="$currentType === 'series'"
               :disabled="false"
               label="Series">
               <x-hugeicons-tissue-paper class="h-6 w-6 text-steel-500"/>
           </x-sidebar-link>
           
           <x-sidebar-link 
               href="{{ route('content.type', ['category' => $currentCategory, 'type' => 'lyric']) }}"
               :active="$currentType === 'lyric'"
               :disabled="false"
               label="Lyric">
               <x-hugeicons-music-note-square-01 class="h-6 w-6 text-steel-500"/>
           </x-sidebar-link>
           
           <x-sidebar-link 
               href="{{ route('content.type', ['category' => $currentCategory, 'type' => 'mech']) }}"
               :active="$currentType === 'mech'"
               :disabled="false"
               label="Mech">
               <x-hugeicons-pulley class="h-6 w-6 text-steel-500"/>
           </x-sidebar-link>
           
           <x-sidebar-link 
               href="{{ route('content.type', ['category' => $currentCategory, 'type' => 'refs']) }}"
               :active="$currentType === 'refs'"
               :disabled="$currentCategory === 'favorite'"
               label="Refs">
               <x-hugeicons-book-bookmark-02 class="h-6 w-6 text-steel-500"/>
           </x-sidebar-link>
       </ul>
   </div>
</aside>