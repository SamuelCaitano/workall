<?php

use App\Http\Controllers\Admin\PageMenuController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SectionMenuController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Se um grupo de rotas utiliza o mesmo controller , você pode usar o controller método para definir o controller comum para todas as rotas dentro do grupo. Então, ao definir as rotas, você só precisa fornecer o método do controller que eles invocam   
 */

Route::get('/', 'HomeController@index')->name('admin.dashboard');  
  
Route::controller(UserProfileController::class)->group( function () {
	Route::group([ 'prefix' => 'userProfile' ], function() { 
		Route::get('', "list");
		Route::delete('{id}', "disable");
		Route::patch('{id}', "enable");
		Route::put('{id}', "save");
	});
});

Route::controller(UserController::class)->group( function () {
	Route::group([ 'prefix' => 'user' ], function() { 
		Route::get('', "list");
		Route::delete('{id}', "disable");
		Route::patch('{id}', "enable");
		Route::put('{id}', "save");
	});
});

Route::controller(SectionMenuController::class)->group( function () {
	Route::group([ 'prefix' => 'sectionMenu' ], function() { 
		Route::get('', "list");
		Route::delete('{id}', "disable");
		Route::patch('{id}', "enable");
		Route::put('{id}', "save");
	});
});

Route::controller(PageMenuController::class)->group( function () {
	Route::group([ 'prefix' => 'pageMenu' ], function() { 
		Route::get('', "list");
		Route::delete('{id}', "disable");
		Route::patch('{id}', "enable");
		Route::put('{id}', "save");
	});
});

Route::controller(PermissionController::class)->group( function () {
	Route::group([ 'prefix' => 'permission' ], function() { 
		Route::get('', "list");
		Route::delete('{id}', "disable");
		Route::patch('{id}', "enable");
		Route::put('{id}', "save");
	});
});