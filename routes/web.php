<?php
Route::get('/', 'TestController@welcome')->name('welcome');
Route::get('/console', 'TestController@console')->name('console');
Route::get('/email/test', 'TestController@sendEmail')->name('sendEmail');

// Auth routes
Route::get('/auth/login/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/auth/login', 'Auth\LoginController@login');
Route::get('/auth/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::get('/auth/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/auth/register', 'Auth\RegisterController@register')->name('register.post');

Route::get('/auth/confirm', 'Auth\UserValidationController@confirmEmail')->name('confirm.email');
Route::get('/auth/confirm/status/{id}', 'Auth\UserValidationController@confirmEmailStatus')->name('confirm.email.status');

Route::get('/auth/reset/paswword/input', 'Auth\UserValidationController@changePasswordEmailInput')->name('auth.reset.password.input');
Route::post('/auth/reset/paswword/validate', 'Auth\UserValidationController@validatePasswordRequest')->name('auth.reset.password.validate');
Route::get('/auth/reset/paswword/send/{email}/{token}', 'Auth\UserValidationController@sendResetEmail')->name('auth.reset.password.send');
Route::get('/auth/reset/paswword/form/{email}/{token}', 'Auth\UserValidationController@changePasswordInput')->name('auth.reset.password.form');
Route::post('/auth/reset/paswword/post', 'Auth\UserValidationController@resetPassword')->name('auth.reset.password.post');

// route only for dev
Route::get('/auth/reset/password', 'Auth\UserValidationController@resetPassword')->name('reset.password');
Route::get('/auth/deconfirm/status/{id}', 'Auth\UserValidationController@deconfirmEmailStatus')->name('deconfirm.email.status');