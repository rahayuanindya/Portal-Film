<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'Dashboard\DashboardController@index');

//users main
Route::middleware('auth')->group(function(){
    Route::get('/dashboard/users', 'Dashboard\UserController@index')->name('dashboard.users');
    Route::get('/dashboard/users/{id}', 'Dashboard\UserController@edit')->name('dashboard.users.edit');
    Route::put('/dashboard/users/{id}', 'Dashboard\UserController@update')->name('dashboard.users.update'); 
    Route::delete('/dashboard/users/{id}', 'Dashboard\UserController@destroy')->name('dashboard.users.delete');
});
