<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware('auth')->group(function(){
    
    Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');
    Route::get('/dashboard/tickets', 'Dashboard\DashboardController@index')->name('dashboard.tickets');
    
    //theaters
    Route::get('/dashboard/theaters', 'Dashboard\TheatersController@index')->name('dashboard.theaters');
    Route::get('/dashboard/theaters/create', 'Dashboard\TheatersController@create')->name('dashboard.theaters.create');
    Route::post('/dashboard/theaters', 'Dashboard\TheatersController@store')->name('dashboard.theaters.store');
    Route::get('/dashboard/theaters/{theaters}', 'Dashboard\TheatersController@edit')->name('dashboard.theaters.edit');
    Route::put('/dashboard/theaters/{theaters}', 'Dashboard\TheatersController@update')->name('dashboard.theaters.update');
    Route::delete('/dashboard/theaters/{theaters}', 'Dashboard\TheatersController@destroy')->name('dashboard.theaters.delete');

    //Movie
    Route::get('/dashboard/movies', 'Dashboard\MovieController@index')->name('dashboard.movies');
    Route::get('/dashboard/movies/create', 'Dashboard\MovieController@create')->name('dashboard.movies.create');
    Route::post('/dashboard/movies', 'Dashboard\MovieController@store')->name('dashboard.movies.store');
    Route::get('/dashboard/movies/{movie}', 'Dashboard\MovieController@edit')->name('dashboard.movies.edit');
    Route::put('/dashboard/movies/{movie}', 'Dashboard\MovieController@update')->name('dashboard.movies.update');
    Route::delete('/dashboard/movies/{movie}', 'Dashboard\MovieController@destroy')->name('dashboard.movies.delete');
    
    //Arrange Movie
    Route::get('/dashboard/theaters/arrange/movies/{theaters}', 'Dashboard\ArrangeMovieController@index')->name('dashboard.theaters.arrange.movies');
    Route::get('/dashboard/theaters/arrange/movies/create/{theaters}', 'Dashboard\ArrangeMovieController@create')->name('dashboard.theaters.arrange.movies.create');
    Route::post('/dashboard/theaters/arrange/movies', 'Dashboard\ArrangeMovieController@store')->name('dashboard.theaters.arrange.movies.store');
    Route::get('/dashboard/theaters/arrange/movies/{theaters}/{arrangeMovie}', 'Dashboard\ArrangeMovieController@edit')->name('dashboard.theaters.arrange.movies.edit');
    Route::put('/dashboard/theaters/arrange/movies/{arrangeMovie}', 'Dashboard\ArrangeMovieController@update')->name('dashboard.theaters.arrange.movies.update');
    Route::delete('/dashboard/theaters/arrange/movies/{arrangeMovie}', 'Dashboard\ArrangeMovieController@destroy')->name('dashboard.theaters.arrange.movies.delete');

    //users 
    Route::get('/dashboard/users', 'Dashboard\UserController@index')->name('dashboard.users');
    Route::get('/dashboard/users/{id}', 'Dashboard\UserController@edit')->name('dashboard.users.edit');
    Route::put('/dashboard/users/{id}', 'Dashboard\UserController@update')->name('dashboard.users.update'); 
    Route::delete('/dashboard/users/{id}', 'Dashboard\UserController@destroy')->name('dashboard.users.delete');
});
