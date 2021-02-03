<?php

Route::get('/', 'TestController@welcome')->name('welcome');
Route::get('/console', 'TestController@console')->name('console');

// Auth routes
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');