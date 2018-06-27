<?php

if (!defined('DEFAULT_VERSION')) {
    define('DEFAULT_VERSION', '1.0');
}

Route::get('/', function () {
    return redirect('/introduction');
});

Route::get('/{version}/{page?}', 'DocumentationController@show');
