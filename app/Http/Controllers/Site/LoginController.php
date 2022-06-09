<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

  function index()
  {
    return view('login');
  } 

  function signIn(Request $request)
  {    
    $credentials = $request->validate([
      'login' => ['required', 'min:5'],
      'password' => ['required'],
    ]); 

    $credentials = [
      'password' => $request->get('password'),
    ];

    // verifica o que esta vindo do login
    $credentials[filter_var($request->get('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username'] = $request->get('login');
    
    // realiza uma tentativas de autenticação
    if (Auth::attempt($credentials)) {    
      // redireciona para a rota informada
        return redirect()->intended('/admin'); 
    }

    // redireciona para a ultima página apenas o login 
    return redirect()->back()->withInput($request->only($request->old('login')));
  }

  // retorna para a tela de login
  function signOut() {
		Auth::logout();

		return redirect('/');
	}

}