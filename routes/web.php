<?php

use Illuminate\Support\Facades\Route;

Route::view('blog', 'press::test');

Route::get('hey', 'TestController@index');