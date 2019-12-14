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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => true]);

Route::get('/', 'Controller@welcome')->name('home');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', 'Controller@admin')->name('admin');
    Route::post('/', 'Controller@saveConfig')->name('admin');
    Route::get('force-sync', 'Controller@forceSync')->name('forceSync');

    Route::get('taskFolders/{provider}', 'Controller@getTasksFolder')->name('taskFolders');
    Route::get('air-quality/stations', 'AirQualityController@getStations')->name('air.getStations');

    //    Route::get('/tasks', 'MicrosoftController@tasks')->name('tasks');
    //    Route::get('air-quality', 'AirQualityController@getInfo')->name('air.getInfo');
    //    Route::get('weather', 'WeatherController@getInfo')->name('weather.getInfo');

    Route::prefix('microsoft')->group(function () {
        Route::get('/zaloguj', 'MicrosoftAuthController@signin')->name('microsoft.signin');
        Route::get('/wyloguj', 'MicrosoftAuthController@signout')->name('microsoft.signout');
    });
    Route::prefix('google')->group(function () {
        Route::get('/zaloguj', 'MicrosoftAuthController@signin')->name('google.signin');
        Route::get('/wyloguj', 'MicrosoftAuthController@signout')->name('google.signout');
    });
});
Route::prefix('callbacks')->group(function () {
    Route::get('/microsoft', 'MicrosoftAuthController@callback');
    Route::get('/google', 'MicrosoftAuthController@callback');
});
