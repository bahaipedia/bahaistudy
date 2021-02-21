<?php

// Testing routes
Route::get('/', 'TestController@welcome')->name('welcome');
Route::get('/console', 'TestController@console')->name('console');
Route::get('/email/test', 'TestController@sendEmail')->name('sendEmail');

// Auth routes
Route::get('/auth/login/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/auth/login', 'Auth\LoginController@login');
Route::get('/auth/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::get('/auth/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/auth/register', 'Auth\RegisterController@register')->name('register.post');
Route::post('/auth/disable', 'Auth\UserValidationController@disable')->name('auth.disable');
Route::post('/auth/enable', 'Auth\UserValidationController@enable')->name('auth.enable');
Route::post('/auth/role', 'Auth\UserValidationController@role')->name('auth.role');
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

// Store data routes
Route::get('/books', 'StoreController@book')->name('store.book');
Route::post('/books', 'StoreController@bookPost')->name('store.book.post');
Route::get('/authors', 'StoreController@author')->name('store.author');
Route::post('/authors', 'StoreController@authorPost')->name('store.author.post');
Route::get('/containers', 'StoreController@container')->name('store.container');
Route::post('/containers', 'StoreController@containerPost')->name('store.container.post');
// Container id parameter
Route::get('/groups/{c?}', 'StoreController@group')->name('store.group');
Route::post('/groups', 'StoreController@groupPost')->name('store.group.post');


// Update data routes
Route::get('/groups/update/{g?}/', 'UpdateController@group')->name('update.group');
Route::put('/groups', 'UpdateController@groupUpdate')->name('update.group.post');

Route::get('/authors/update/{g?}/', 'UpdateController@author')->name('update.author');
Route::put('/authors', 'UpdateController@authorUpdate')->name('update.author.post');

// List views routes
Route::get('/list/books', 'ListController@books')->name('list.books');
Route::get('/list/authors', 'ListController@authors')->name('list.authors');
Route::get('/list/containers', 'ListController@containers')->name('list.containers');
Route::get('/list/users', 'ListController@users')->name('list.users');

// Group routes
Route::get('/group/dashboard/{g?}', 'GroupController@dashboard')->name('group.dashboard');
Route::post('/group/stepdown/', 'GroupController@stepdown')->name('group.stepdown');
Route::post('/group/stepup/', 'GroupController@stepup')->name('group.stepup');
Route::post('/group/retire/', 'GroupController@retire')->name('group.retire');
Route::post('/group/join/', 'GroupController@join')->name('group.join');

// Api routes
Route::get('/api/group/participant/{id}', 'GroupController@apiParticipant')->name('api.group.participant');


