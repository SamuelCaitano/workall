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
  @stack('css')

  <script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content
  </script>
</head>

<body>
  <div class="md:h-screen bg-white relative flex flex-col space-y-10 justify-center items-center">
    <div class="md:border md:border-gray-200 bg-white md:shadow-xl shadow-none rounded p-8 w-96">
      <h1 class="leading-normal title text-center">Work<strong class="text-red-600">all</strong></h1>
      <p class="text-sm leading-normal">O lugar dos profissionais de verdade</p>
      <form class="space-y-5 mt-5" action="/login/signIn" method="POST">
        @csrf
        <div class="mb-4 relative">
          <input name="login" id="login" type="text" value="{{ old('login') }}"
            class="w-full rounded px-3 border border-gray-500 pt-5 pb-2 focus:border-blue-500 focus:outline-none input active:outline-none"
            autofocus required>
          <label for="login"
            class="label absolute mb-0 -mt-2 pt-4 pl-3 leading-tighter text-gray-500 text-base mt-2 cursor-text">E-mail
            ou usuário </label>
        </div>
        <div
          class="relative flex items-center border border-gray-500 focus:border-blue-500 rounded focus:outline-none active:outline-none">
          <input name="password" id="password" type="password"
            class="w-full rounded px-3 pt-5 outline-none pb-2 focus:outline-none active:outline-none input active:border-blue-500"
            required />
          <label for="password"
            class="label absolute mb-0 -mt-2 pt-4 pl-3 leading-tighter text-gray-500 text-base mt-2 cursor-text">Senha</label>
          <a class="text-sm font-bold text-blue-700 hover:text-gray-600 px-2 py-1 mr-0 leading-normal cursor-pointer"
            onclick="showHide()" aria-autocomplete="none">
            <i class="fa-solid fa-eye"></i>
          </a>
        </div>
        <div class="-m-2">
          <a class="font-bold text-blue-600 hover:underline p-2 rounded-full border-white" href="#">Esqueceu a
            senha?</a>
        </div>
        <button
          class="w-full text-center bg-blue-600 hover:bg-blue-700 rounded text-white py-3 font-medium">Entrar</button>
      </form>
    </div>
    <p>Novo no Workall?<a class="text-blue-600 font-bold hover:underline hover:p-5 p-2 rounded-full"
        href="{{ url('signUp') }}">criar
        conta</a>
    </p>
  </div>
  <!-- Script to show and hide password-->
  <script src="{!! asset('js/showHide.js') !!}"></script>
</body>

</html>
