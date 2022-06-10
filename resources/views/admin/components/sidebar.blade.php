<!-- Styles -->
<link rel="stylesheet" href="{!! asset('css/sidebar.css') !!}">

<div id="sidebar" :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
  class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-dark-1 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0 dark:bg-black-900">
  <div class="flex items-center justify-center mt-8">
    <div class="flex items-center">
      <h1 class="text-3xl font-bold leading-normal"><span class="text-white">Work</span><strong
          class="text-red-600">all</strong></h1>
    </div>
  </div>

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

    {{-- <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
      href="#">
      <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z">
        </path>
      </svg>

      <span class="mx-3">UI Elements</span>
    </a> --}}

    <!-- criar foreach para os modulos -->
    <div class="tabs flex justify-center overflow-hidden">
      <div class="tab text-white overflow-hidden w-64 mt-1">
        <!-- pegar o id do modulo e inserir no id  do input-->
        <input type="checkbox" id="chck1" class="checkbox-sidebar absolute opacity-0 z-0">
        <!-- pegar o nome do modulo-->
        <label
          class="tab-label cursor-pointer flex items-center py-2 px-6 justify-between bg-transparent p-2 text-gray-500  hover:bg-gray-700 hover:bg-opacity-25"
          for="chck1">
          <i class="fas fa-gears"></i>
          <span>Config. Usuário</span>
        </label>
        <div class="tab-content">
          <!-- foreach na paginas -->
          <div class="w-64 hover:bg-gray-400">
            <div class="link">
              <a class="flex items-center cursor-pointer ml-5 w-full h-8" href="/admin/userProfile">
                <span class="flex items-center justify-center w-7 h-7"><i
                    class="fa-solid fa-address-card text-xl"></i></span>
                <span class="mx-3">Perfil</span>
              </a>
            </div>
          </div>
          <!-- endforeach -->
          <div class="w-64 hover:bg-gray-400">
            <div class="link">
              <a class="flex items-center cursor-pointer ml-5 w-full h-8"  href="/admin/user"><span
                  class="flex items-center justify-center w-7 h-7"><i class="fa-solid fa-user text-xl"></i></span><span
                  class="mx-3">Usuário</span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- endforeach -->

    <!-- criar foreach para os modulos -->
    <div class="tabs flex justify-center overflow-hidden">
      <div class="tab text-white overflow-hidden w-64 mt-1">
        <!-- pegar o id do modulo e inserir no id  do input-->
        <input type="checkbox" id="chck2" class="checkbox-sidebar absolute opacity-0 z-0">
        <!-- pegar o nome do modulo-->
        <label
          class="tab-label cursor-pointer flex items-center py-2 px-6 justify-between bg-transparent p-2 text-gray-500  hover:bg-gray-700 hover:bg-opacity-25"
          for="chck2">
          <i class="fas fa-gears"></i>
          <span>Config. Pág. Menu</span>
        </label>
        <div class="tab-content">
          <!-- foreach na paginas -->
          <div class="w-64 hover:bg-gray-400">
            <div class="link">
              <a class="flex items-center cursor-pointer ml-5 w-full h-8" href="/admin/sectionMenu">
                <span class="flex items-center justify-center w-7 h-7"><i
                    class="fa-solid fa-address-card text-xl"></i></span>
                <span class="mx-3">Seção do Menu</span>
              </a>
            </div>
          </div>
          <!-- endforeach -->
          <div class="w-64 hover:bg-gray-400">
            <div class="link">
              <a class="flex items-center cursor-pointer ml-5 w-full h-8"  href="/admin/pageMenu"><span
                  class="flex items-center justify-center w-7 h-7"><i class="fa-solid fa-user text-xl"></i></span><span
                  class="mx-3">Página do Menu</span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- endforeach -->
  </nav>
</div>
