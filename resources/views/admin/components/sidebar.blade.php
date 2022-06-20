<!-- Styles -->
<link rel="stylesheet" href="{!! asset('css/sidebar.css') !!}">

<div id="sidebar" :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
  class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-dark-1 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0 dark:bg-black-900">
  <div class="flex items-center justify-center mt-8">
    <div class="flex items-center">
      <a href="/admin/">
        <h1 class="text-3xl font-bold leading-normal">
          <span class="text-white">Work</span><strong class="text-red-600">all</strong>
        </h1>
      </a>
    </div>
  </div>

<<<<<<< HEAD
  <nav class="mt-10">
    <a class="flex items-center mt-4 py-2 px-6 bg-gray-700 bg-opacity-25 text-gray-100" href="/admin/">
      <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
      </svg>
      <span class="mx-3">Dashboard</span>
    </a>
    @foreach (sidebar() as $section)
      <div class="tabs flex justify-center overflow-hidden">
        <div class="tab text-white overflow-hidden w-64 mt-1">
          <input type="checkbox" id="sidebarDropdonw_{{ $section->key }}"
            class="checkbox-sidebar absolute opacity-0 z-0">
          <label
            class="tab-label cursor-pointer flex items-center py-2 px-6 justify-between bg-transparent p-2 text-base text-gray-400 hover:bg-gray-700 hover:bg-opacity-25"
            for="sidebarDropdonw_{{ $section->key }}">
            <i class="{{ $section->icon }}"></i>
            <span>{{ $section->name }}</span>
          </label>
          <div class="tab-content bg-gray-700 bg-opacity-25">
            @foreach ($section->pageMenu as $page)
              <div class="w-64 hover:bg-gray-700 hover:bg-opacity-25">
                <div class="link">
                  <a class="flex items-center cursor-pointer ml-5 w-full h-8 text-gray-100"
                    href="/admin/{{ $page->key }}"><span class="flex items-center justify-center w-7 h-7"><i
                        class="{{ $page->icon }} text-xl"></i></span><span
                      class="mx-3">{{ $page->name }}</span></a>
=======
    <nav class="mt-10">
        <a class="flex items-center mt-4 py-2 px-6 bg-gray-700 bg-opacity-25 text-gray-100" href="/admin/">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
            </svg>
            <span class="mx-3">Dashboard</span>
        </a>
        @foreach (sidebar() as $section)
            <div class="tabs flex justify-center overflow-hidden">
                <div class="tab text-white overflow-hidden w-64 mt-1">
                    <input type="checkbox" id="sidebarDropdonw_{{ $section->key }}"
                        class="checkbox-sidebar absolute opacity-0 z-0">
                    <label
                        class="tab-label cursor-pointer flex items-center py-2 px-6 justify-between bg-transparent p-2 text-base text-gray-400 hover:bg-gray-700 hover:bg-opacity-25"
                        for="sidebarDropdonw_{{ $section->key }}">
                        <i class="{{ $section->icon }}"></i>
                        <span>{{ $section->name }}</span>
                    </label>
                    <div class="tab-content bg-gray-700 bg-opacity-25">
                        @foreach ($section->pageMenu as $page)
                            <div class="w-64 hover:bg-gray-700 hover:bg-opacity-25">
                                <div class="link">
                                    <a class="flex items-center cursor-pointer ml-5 w-full h-8 text-gray-100"
                                        href="/admin/{{ $page->key }}"><span class="flex items-center justify-center w-7 h-7"><i
                                                class="{{ $page->icon }} text-xl"></i></span><span
                                            class="mx-3">{{ $page->name }}</span></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
>>>>>>> a77d27a61ed3b3e5d2e562f487c8991b1a62d441
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    @endforeach
  </nav>
</div>
