<!DOCTYPE html>
<html lang="pt-br" class="border-l">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dashboard - @yield('title')</title>
  {{-- Favicon --}}
  <link rel="shortcut icon" href="/assets/img/favicon.png" type="image/x-icon">
  {{-- Tailwindcss --}}
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  {{-- Cascading Style Sheets - CSS --}}
  <link rel="stylesheet" href="/css/styles.css">
  {{-- FontAwesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  {{-- Flowbite  --}}
  <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
  @stack('css')

  <script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content
  </script>
</head>

<body> 
  <!-- component -->
  <div class="bg-white dark:bg-gray-900">
    <div class="flex justify-center h-screen">
      <div class="hidden bg-cover lg:block lg:w-2/3"
        style="background-image: url(https://images.unsplash.com/photo-1616763355603-9755a640a287?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80)">
        <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
          <div>
            <h2 class="text-4xl font-bold text-white">Brand</h2>

            <p class="max-w-xl mt-3 text-gray-300">Lorem ipsum dolor sit, amet consectetur adipisicing elit. In autem
              ipsa, nulla laboriosam dolores, repellendus perferendis libero suscipit nam temporibus molestiae</p>
          </div>
        </div>
      </div>

      <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
        <div class="flex-1">
          <div class="text-center">
            <h1 class="leading-normal title text-center">Work<strong class="text-red-600">all</strong></h1>
            <p class="mt-3 text-gray-500 dark:text-gray-300">Faça login para acessar sua conta</p>
          </div>

          <div class="mt-8">
            <form class="space-y-5 mt-5" action="/login/signIn" method="POST">
              @csrf
              <div class="mb-4 relative">
                <input type="text" name="login" id="login" value="{{ old('login') }}"
                  class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                  autofocus required placeholder=" " />
                <label for="login"
                  class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-800 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">E-mail
                  ou usuário</label>
              </div>
              <div class="mb-4 relative">
                <input type="password" id="password" name="password"
                  class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                  autofocus required placeholder=" " />
                <label for="password"
                  class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-800 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Senha</label>
                {{-- <a class="text-sm font-bold text-blue-700 hover:text-gray-600 px-2 py-1 mr-0 leading-normal cursor-pointer"
                  onclick="showHide()" aria-autocomplete="none">
                  <i class="fa-solid fa-eye"></i>
                </a> --}}
              </div>  
              <div class="-m-2">
                <a href="#" class="text-blue-500 hover:underline p-2 hover:text-blue-600" >Esqueceu a
                  senha?</a>
              </div> 
              <div class="mt-6">
                <button
                  class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                  Entrar
                </button>
              </div>
            </form>
            <p class="mt-6 text-sm text-center text-gray-800">Novo no Workall?<a
                class="text-blue-500 font-bold hover:underline hover:p-5 p-2 rounded-full"
                href="{{ url('signUp') }}">criar
                conta</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Script to show and hide password-->
  <script src="{!! asset('js/showHide.js') !!}"></script>
  <script src="../path/to/flowbite/dist/flowbite.js"></script>
  <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js" defer></script>
</body>

</html>
