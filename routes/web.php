<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'Dashboard\DashboardController@index');

//users main
Route::get('/dashboard/users', 'Dashboard\UserController@index');
Route::get('/dashboard/user/edit/{id}', 'Dashboard\UserController@edit');
Route::put('/dashboard/user/update/{id}', 'Dashboard\UserController@update'); 
Route::delete('/dashboard/user/delete/{id}', 'Dashboard\UserController@destroy');
