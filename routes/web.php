<?php

Route::get('/', 'TestController@welcome')->name('welcome');
Route::get('/console', 'TestController@console')->name('console');
Route::get('/email/test', 'TestController@sendEmail')->name('sendEmail');


// Auth routes
Route::get('/auth/login/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/auth/login', 'Auth\LoginController@login');
Route::get('/auth/register', 'Auth\RegisterController@showRegistrationForm')->name('register');

// it will send email with user encriptation the next method will validate the user id with auth user id and then it will show a view with a button with
// the email_confirmation post
// replicate this steps with the register controller
Route::get('/auth/confirm', 'Auth\UserValidationController@confirmEmail')->name('confirm.email');
Route::get('/auth/confirm/status/{id}', 'Auth\UserValidationController@confirmEmailStatus')->name('confirm.email.status');
// route only for dev
Route::get('/auth/deconfirm/status/{id}', 'Auth\UserValidationController@deconfirmEmailStatus')->name('deconfirm.email.status');
Route::get('/auth/reset/password', 'Auth\UserValidationController@resetPassword')->name('reset.password');

// Route::post('register', 'Auth\RegisterController@register');
Route::get('/auth/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/auth/register', 'Auth\RegisterController@register')->name('register.post');