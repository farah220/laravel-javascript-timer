<?php

use Illuminate\Support\Facades\Route;
Route::view('/','auth.login')->name('web.login-form');
Route::view('/register','auth.register')->name('web.register-form');

Route::post('/web/login','App\Http\Controllers\auth\AuthController@Login')->name('web.login');
Route::post('/web/register','App\Http\Controllers\auth\AuthController@register')->name('web.register');
Route::post('/web/logout','App\Http\Controllers\auth\AuthController@logout')->name('web.logout');
Route::resource('timers','\App\Http\Controllers\TimerController')->only(['store','index','update'])->middleware('web');




