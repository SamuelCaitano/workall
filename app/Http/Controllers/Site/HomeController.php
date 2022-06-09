<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
  function index()
  {
    return view('site.home');
  }
}
