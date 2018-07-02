<?php

if (!defined('DEFAULT_VERSION')) {
    define('DEFAULT_VERSION', '1.0');
}

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('docs', 'Admin\DocumentationController');
    Route::resource('categories', 'Admin\CategoriesController');
});

Route::get('menu/{version}/{page}', 'DocMenuController')->name('menu');

Route::get('/', function () {
    return redirect('/introduction');
});

Route::get('/{version}/{page?}', 'DocumentationController@show');


