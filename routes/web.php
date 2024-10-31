<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/goodbye', function () {
    return 'Goodbye World';
});

Route::get('/hello', function () {
    return 'Goodbye World';
});


// Route::get('/index', function () {
//     return view('/index');
// });

Route::get('/page1',[ProductController::class, 'page1']);
Route::get('/page2',[ProductController::class, 'page2']);

Route::get('/user/{id}',[UserController::class, 'show']);




Route::controller(UserController::class)->group(function(){
    Route::get('/register', 'register',)->name('register');
    Route::post('/register', 'registerSave',)->name('register.save');
    Route::get('/login', 'login' )->name('login');
    Route::post('/login', 'loginAction' )->name('login.action');
    Route::post('/logout', 'logout', )->middleware('auth')->name('logout');

});


Route::middleware('auth')->group(function(){
    Route::controller(ProductController::class)->prefix('products')->group(function (){
        Route::get('/', 'index')->name('products');
        Route::get('/create', 'create',)->name('products.create');
        Route::post('/store', 'store',)->name('products.store');
        Route::get('/edit/{id}', 'edit',)->name('products.edit');
        Route::put('/edit/{id}', 'update',)->name('products.update');
        Route::delete('/destroy/{id}', 'destroy',)->name('products.destroy');


    });
});


