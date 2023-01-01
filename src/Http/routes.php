<?php

use Dcat\Admin\ApiTester\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::resource('ycookies/api-tester', Controllers\ApiTesterController::class);
Route::post('ycookies/api-tester/handle', Controllers\ApiTesterController::class.'@handle')->name('api-tester-handle');
Route::post('ycookies/api-tester/run', Controllers\ApiTesterController::class.'@run')->name('api-tester-run');

Route::resource('ycookies/proj', Controllers\CgkjProjController::class);
Route::any('ycookies/api-tester/proj/apidoc', Controllers\ApiTesterController::class.'@apidoc')->name('ycookies.apidoc');
Route::any('ycookies/api-tester/proj/jsonBuild', Controllers\CgkjProjController::class.'@jsonBuild')->name('ycookies.jsonBuild');