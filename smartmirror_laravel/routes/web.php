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
Route::get('/pomoc', 'Controller@help')->name('help');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', 'AdminPanelController@getConfigurationPage')->name('admin.getConfiguration');
    Route::get('external-accounts', 'AdminPanelController@getExternalAccountsPage')->name('admin.getExternalAccounts');
    Route::get('test-websockets', 'AdminPanelController@getWebsocketsTestPage')->name('admin.getWebsocketsTest');
    Route::get('help', 'AdminPanelController@getHelpPage')->name('admin.getHelp');
    Route::get('changelog', 'AdminPanelController@getChangelogPage')->name('admin.getChangelog');
    Route::get('info', 'AdminPanelController@getInfoPage')->name('admin.info');

    Route::post('/', 'Controller@saveConfig')->name('admin');

    Route::post('/configuration/setActive/{feature}/{active?}', 'ConfigurationController@setActive')->name('configuration.setActive');


    Route::get('test-websockets/{feature}', 'WebsocketTestController@getData')->name('testWebsocketsData');

    Route::get('taskFolders/{provider}', 'Controller@getTasksFolder')->name('taskFolders');
    Route::get('air-quality/stations', 'AirQualityController@getStations')->name('air.getStations');

    Route::prefix('external-accounts')->group(function () {
        Route::prefix('microsoft')->group(function () {
            Route::get('/zaloguj', 'Auth\MicrosoftAuthController@signin')->name('microsoft.signin');
            Route::get('/wyloguj', 'Auth\MicrosoftAuthController@signout')->name('microsoft.signout');
        });
        //ToDo:Zrobić logowanie google
        Route::prefix('google')->group(function () {
            Route::get('/zaloguj', 'MicrosoftAuthController@signin')->name('google.signin');
            Route::get('/wyloguj', 'MicrosoftAuthController@signout')->name('google.signout');
        });
    });
});

Route::prefix('callbacks')->group(function () {
    Route::get('/microsoft', 'Auth\MicrosoftAuthController@callback');
    Route::get('/google', 'Auth\MicrosoftAuthController@callback');
});
