<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // This tells Laravel to look for resources/views/welcome.blade.php
    return view('welcome');
});