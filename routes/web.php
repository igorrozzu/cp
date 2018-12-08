
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('{reactRoutes}', HomeController::class . '@index')
    ->where('reactRoutes', '^((?!api).)*$'); // except 'api' word

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', AuthController::class . '@login');
    Route::post('/check-login', AuthController::class . '@getAuthUser');
});