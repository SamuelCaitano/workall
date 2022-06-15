<?php
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('admin.dashboard');  
  
Route::group([ 'prefix' => 'userProfile' ], function() {
  $ctrll = 'UserProfileController@';
	Route::get('', "{$ctrll}list");
	Route::delete('{id}', "{$ctrll}disable");
	Route::patch('{id}', "{$ctrll}enable");
	Route::put('{id}', "{$ctrll}save");
});

Route::group([ 'prefix' => 'user' ], function() {
  $ctrll = 'UserController@';
	Route::get('', "{$ctrll}list");
	Route::delete('{id}', "{$ctrll}disable");
	Route::patch('{id}', "{$ctrll}enable");
	Route::put('{id}', "{$ctrll}save");
});

Route::group([ 'prefix' => 'sectionMenu' ], function() {
  $ctrll = 'SectionMenuController@';
	Route::get('', "{$ctrll}list");
	Route::delete('{id}', "{$ctrll}disable");
	Route::patch('{id}', "{$ctrll}enable");
	Route::put('{id}', "{$ctrll}save");
});

Route::group([ 'prefix' => 'pageMenu' ], function() {
  $ctrll = 'PageMenuController@';
	Route::get('', "{$ctrll}list");
	Route::delete('{id}', "{$ctrll}disable");
	Route::patch('{id}', "{$ctrll}enable");
	Route::put('{id}', "{$ctrll}save");
});

Route::group([ 'prefix' => 'permission' ], function() {
  $ctrll = 'PermissionController@';
	Route::get('', "{$ctrll}list");
	Route::delete('{id}', "{$ctrll}disable");
	Route::patch('{id}', "{$ctrll}enable");
	Route::put('{id}', "{$ctrll}save");
});


