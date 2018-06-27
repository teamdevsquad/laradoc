<?php

if (!defined('DEFAULT_VERSION')) {
    define('DEFAULT_VERSION', '1.0');
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('/docs/{version}/{page?}', 'DocumentationController@show');
