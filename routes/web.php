<?php

// General routes
Route::get('/', 'GeneralController@welcome')->name('welcome');
Route::get('/api/author/book/{id}', 'GeneralController@apiAuthorBook')->name('api.author.book');

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
Route::get('/auth/reset/paswword/send/{email}/{tSoken}', 'Auth\UserValidationController@sendResetEmail')->name('auth.reset.password.send');
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
Route::delete('/groups/delete', 'UpdateController@groupDelete')->name('delete.group.post');

Route::get('/authors/update/{g?}/', 'UpdateController@author')->name('update.author');
Route::put('/authors', 'UpdateController@authorUpdate')->name('update.author.post');
Route::delete('/authors/delete', 'UpdateController@authorDelete')->name('delete.author.post');

Route::get('/books/update/{g?}/', 'UpdateController@book')->name('update.book');
Route::put('/books', 'UpdateController@bookUpdate')->name('update.book.post');
Route::delete('/books/delete', 'UpdateController@bookDelete')->name('delete.book.post');

Route::get('/users/update/{g?}/', 'UpdateController@user')->name('update.user');
Route::put('/users', 'UpdateController@userUpdate')->name('update.user.post');
// List views routes
Route::get('/list/books', 'ListController@books')->name('list.books');
Route::get('/list/authors', 'ListController@authors')->name('list.authors');
Route::get('/list/containers', 'ListController@containers')->name('list.containers');
Route::get('/list/users', 'ListController@users')->name('list.users');

// Group routes
Route::get('/group/dashboard/{g?}', 'GroupController@dashboard')->name('group.dashboard');
Route::post('/group/stepdown/', 'GroupController@stepdown')->name('group.stepdown');
Route::post('/group/stepup/', 'GroupController@stepup')->name('group.stepup');
Route::post('/group/leave/', 'GroupController@leave')->name('group.leave');
Route::post('/group/join/', 'GroupController@join')->name('group.join');
// NEW ROUTE IN LAYOUT ENV
Route::post('/group/message/', 'GroupController@message')->name('group.message');

// Api routes
Route::get('/api/group/participant/{id}', 'GroupController@apiParticipant')->name('api.group.participant');
Route::post('/api/group/beat', 'GroupController@apiBeat')->name('api.group.beat');





Route::get('/dev', 'Dev\TestController@welcome')->name('dev.welcome');


// Store data routes
Route::get('/dev/books', 'Dev\StoreController@book')->name('dev.store.book');
Route::post('/dev/books', 'Dev\StoreController@bookPost')->name('dev.store.book.post');
Route::get('/dev/authors', 'Dev\StoreController@author')->name('dev.store.author');
Route::post('/dev/authors', 'Dev\StoreController@authorPost')->name('dev.store.author.post');
Route::get('/dev/containers', 'Dev\StoreController@container')->name('dev.store.container');
Route::post('/dev/containers', 'Dev\StoreController@containerPost')->name('dev.store.container.post');
// Container id parameter
Route::get('/dev/groups/{c?}', 'Dev\StoreController@group')->name('dev.store.group');
Route::post('/dev/groups', 'Dev\StoreController@groupPost')->name('dev.store.group.post');


// Update data routes
Route::get('/dev/groups/update/{g?}/', 'Dev\UpdateController@group')->name('dev.update.group');
Route::put('/dev/groups', 'Dev\UpdateController@groupUpdate')->name('dev.update.group.post');
Route::delete('/dev/groups/delete', 'Dev\UpdateController@groupDelete')->name('dev.delete.group.post');

Route::get('/dev/authors/update/{g?}/', 'Dev\UpdateController@author')->name('dev.update.author');
Route::put('/dev/authors', 'Dev\UpdateController@authorUpdate')->name('dev.update.author.post');
Route::delete('/dev/authors/delete', 'Dev\UpdateController@authorDelete')->name('dev.delete.author.post');

Route::get('/dev/books/update/{g?}/', 'Dev\UpdateController@book')->name('dev.update.book');
Route::put('/dev/books', 'Dev\UpdateController@bookUpdate')->name('dev.update.book.post');
Route::delete('/dev/books/delete', 'Dev\UpdateController@bookDelete')->name('dev.delete.book.post');

Route::get('/dev/users/update/{g?}/', 'Dev\UpdateController@user')->name('dev.update.user');
Route::put('/dev/users', 'Dev\UpdateController@userUpdate')->name('dev.update.user.post');
// List views routes
Route::get('/dev/list/books', 'Dev\ListController@books')->name('dev.list.books');
Route::get('/dev/list/authors', 'Dev\ListController@authors')->name('dev.list.authors');
Route::get('/dev/list/containers', 'Dev\ListController@containers')->name('dev.list.containers');
Route::get('/dev/list/users', 'Dev\ListController@users')->name('dev.list.users');

// Group routes
Route::post('/dev/group/stepdown/', 'Dev\GroupController@stepdown')->name('dev.group.stepdown');
Route::post('/dev/group/stepup/', 'Dev\GroupController@stepup')->name('dev.group.stepup');
Route::post('/dev/group/leave/', 'Dev\GroupController@leave')->name('dev.group.leave');
Route::post('/dev/group/join/', 'Dev\GroupController@join')->name('dev.group.join');


// Api routes
Route::get('/dev/api/group/participant/{id}', 'Dev\GroupController@apiParticipant')->name('dev.api.group.participant');
Route::post('/dev/api/group/beat', 'Dev\GroupController@apiBeat')->name('dev.api.group.beat');
Route::get('/dev/api/message/poll/{id}', 'Dev\GroupController@apiMessagePoll')->name('dev.api.message.poll');



Route::post('/dev/admin/group/drop', 'Dev\AdminController@groupDrop')->name('dev.admin.group.drop');
Route::get('/dev/admin/messages', 'Dev\AdminController@messages')->name('dev.admin.messages');
Route::get('/dev/admin/api/messages/{m?}', 'Dev\AdminController@apiMessages')->name('dev.admin.api.messages');



// CHANGED ROUTES
Route::post('/dev/group/message/', 'Dev\GroupController@message')->name('dev.group.message');
Route::get('/dev/{title}/{g?}', 'Dev\GroupController@dashboard')->name('dev.group.dashboard');
// GROUPCONTROLLER, LIST/CONTAINER.BLADE.PHP, GROUP/DASHBOARD 
