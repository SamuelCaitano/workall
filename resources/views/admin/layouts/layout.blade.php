<!DOCTYPE html>
<html lang="pt-br" class="border-l">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard - @yield('title')</title>
  {{-- FontAwesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  {{-- Favicon --}}
  <link rel="shortcut icon" href="/assets/img/favicon.png" type="image/x-icon">
  {{-- Tailwindcss --}}
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  {{-- Cascading Style Sheets - CSS --}}
  <link rel="stylesheet" href="/css/styles.css"> 
  @stack('css')

  <script>
		const csrfToken = document.querySelector('meta[name="csrf-token"]').content
	</script>
</head> 
<body id="dark">
  <div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
      <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
        class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden">
      </div>
      <!-- Sidebar -->
      @include('admin.components.sidebar')

      <div class="flex-1 flex flex-col overflow-hidden">

        <!-- header -->
        @include('admin.components.header')

        <!-- Main -->
        {{-- @include('admin.layouts.main') --}}
        <div class="h-screen mr-3 ml-3 pt-10 transition-all duration-300">
          @yield('content')
        </div>
      </div>
    </div>
  </div>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="/js/appAdmin.js"></script>
  @stack('js')
</body> 