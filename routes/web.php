<?php

use App\Http\Controllers\AnnounceController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Inscription;
use App\Http\Controllers\TretmentControllers;
use App\Http\Controllers\SingleActionController;
use App\Http\Controllers\UserController;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//static
Route::view("/", "pages.landing_page.index");
Route::view("/location", "pages.landing_page.location");
Route::view("/about", "pages.landing_page.about");
Route::view("/privacy", "pages.landing_page.condition");
Route::view("/contact", "pages.landing_page.contact");
Route::view("/home", "pages.landing_page.index");

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
    Route::view("/", "pages.user.index")->name('dashboard');
    Route::resource('/announces', AnnounceController::class);
    Route::resource('/profile', UserController::class);
    Route::post('/comment', [CommentController::class, 'store'])->name('comment');
    Route::get('/comments/{id}', [CommentController::class, 'index'])->name('comments');
});

Route::group(['prefix' => 'admin'] , function(){
    //admin
});

Route::get("/location", [AnnounceController::class, "allAnnonces"])->name("location");
Route::get("/vente", [AnnounceController::class, "allAnnonces"])->name("vente");



?>
