<?php

use Dcat\Admin\ApiTester\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::resource('ycookies/api-tester', Controllers\ApiTesterController::class);
Route::post('ycookies/api-tester/handle', Controllers\ApiTesterController::class.'@handle')->name('api-tester-handle');
