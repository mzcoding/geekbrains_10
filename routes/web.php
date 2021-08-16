<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;
//controllers
use App\Http\Controllers\NewsController;
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
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
	Route::get('/', IndexController::class)->name('index');
	Route::resource('categories', AdminCategoryController::class);
	Route::resource('news', AdminNewsController::class);
});

Route::group(['prefix' => 'news'], function() {
	Route::get('/', [NewsController::class, 'index'])
		->name('news');
	Route::get('/show/{news}', [NewsController::class, 'show'])
		->where('news', '\d+')
		->name('news.show');
});

Route::get('collection', function() {
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



