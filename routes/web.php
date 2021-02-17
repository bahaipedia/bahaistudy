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
// DEP Route::post('/file/test/post', 'TestController@s3template')->name('file.test.post');
// DEP Route::get('/file/test', 'TestController@s3form')->name('file.test');

// rules for routes

// THIS RULES ARE FOR DATA INTERACTION
// store, update, delete -> controllers for each methods
// wich object to store, update or delete
// it is a form or it is a post?

// create and store data routes
Route::get('/list/books', 'ListController@books')->name('list.books');
Route::get('/store/book/form', 'StoreController@book')->name('store.book');
Route::post('/store/book/post', 'StoreController@bookPost')->name('store.book.post');


Route::get('/list/authors', 'ListController@authors')->name('list.authors');
Route::get('/store/author/form', 'StoreController@author')->name('store.author');
Route::post('/store/author/post', 'StoreController@authorPost')->name('store.author.post');

Route::get('/list/containers', 'ListController@containers')->name('list.containers');
Route::get('/store/container/form', 'StoreController@container')->name('store.container');
Route::post('/store/container/post', 'StoreController@containerPost')->name('store.container.post');

Route::get('/store/group/form/{c?}', 'StoreController@group')->name('store.group');
Route::post('/store/group/post', 'StoreController@groupPost')->name('store.group.post');