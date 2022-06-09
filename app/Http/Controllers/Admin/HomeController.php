<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
  function index()
  { 
    return view('admin.pages.home');
  }
}
