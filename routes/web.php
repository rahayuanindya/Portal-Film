<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware('auth')->group(function(){
    
    Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');

    

    Route::get('/dashboard/theaters', 'Dashboard\DashboardController@index')->name('dashboard.theaters');
    Route::get('/dashboard/tickets', 'Dashboard\DashboardController@index')->name('dashboard.tickets');
    
    //Movie
    Route::get('/dashboard/movies', 'Dashboard\MovieController@index')->name('dashboard.movies');
    Route::get('/dashboard/movies/create', 'Dashboard\MovieController@create')->name('dashboard.movies.create');
    Route::post('/dashboard/movies', 'Dashboard\MovieController@store')->name('dashboard.movies.store');
    Route::get('/dashboard/movies/{id}', 'Dashboard\MovieController@edit')->name('dashboard.movies.edit');
    Route::delete('/dashboard/movies', 'Dashboard\MovieController@destroy')->name('dashboard.movies.delete');
    
    //users 
    Route::get('/dashboard/users', 'Dashboard\UserController@index')->name('dashboard.users');
    Route::get('/dashboard/users/{id}', 'Dashboard\UserController@edit')->name('dashboard.users.edit');
    Route::put('/dashboard/users/{id}', 'Dashboard\UserController@update')->name('dashboard.users.update'); 
    Route::delete('/dashboard/users/{id}', 'Dashboard\UserController@destroy')->name('dashboard.users.delete');
});
