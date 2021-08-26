<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ParserController;

//controllers
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\Account\IndexController as AccountController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function() {
	   Route::get('/account', AccountController::class)
	                 ->name('account');

       Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function() {
	     Route::get('/', IndexController::class)->name('index');
	     Route::get('/parser', ParserController::class)->name('parser');
	     Route::resource('categories', AdminCategoryController::class);
	     Route::resource('news', AdminNewsController::class);
      });
});

Route::group(['prefix' => 'news'], function() {
	Route::get('/', [NewsController::class, 'index'])
		->name('news');
	Route::get('/show/{news}', [NewsController::class, 'show'])
		->where('news', '\d+')
		->name('news.show');
});

Route::get('collection', function() {
	//session(['new_session' => 1]);
	// session()->put('key', 'value');

	//if(session()->has('key')) {
		//session()->forget('new_session');
		//dd(session()->all());
	//}

	//session()->forget('new_session');

	$collect = collect([
		['name' => 'Anna', 'age' => 20, 'work' => 'IT'],
		['name' => 'Mike', 'age' => 28, 'work' => 'IT'],
		['name' => 'Kate', 'age' => 25, 'work' => 'Education'],
		['name' => 'Jhon', 'age' => 33, 'work' => 'Marketing'],
		['name' => 'Liza', 'age' => 35, 'work' => 'Ads']
	]);

	dd(
	   $collect->where('work', '=', 'IT')->shuffle()
	);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'guest'], function() {
	Route::get('/init/vkontakte', [SocialController::class, 'init'])
		->name('vk.init');
	Route::get('/callback/vkontakte', [SocialController::class, 'callback'])
		->name('vk.callback');
});