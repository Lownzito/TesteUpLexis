<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;

Route::controller(HomePageController::class)->group(function() {
    Route::get('/', 'homePage')->name('home');

    //Rota usada pelo o Ajax para que retorne os carros
    Route::get('/search', 'search')->name('search.do');

    Route::get('/getPrice', 'getPrice');

    Route::get('/scrape' , 'scrape');
});

Route::controller(AuthController::class)->group(function() {
    Route::get('/login' , 'login')->name('login');
    Route::post('/login' , 'doLogin')->name('login.do');
    Route::get('/registration/form', 'registrationScreen')->name('registration.form');
    Route::post('/registration', 'registerUser')->name('registration.do');
    Route::get('/logout' , 'doLogout')->name('logout');
});

Route::controller(AdminController::class)->group(function() {
    //Retorna o dashboard de admin
    Route::get('/admin' , 'adminPage')->name('admin.page');
    //Deleta o carro cadastrado na base de dados
    Route::get('/adminDeleteCar' , 'deleteFromDB')->name('admin.delete');
});






