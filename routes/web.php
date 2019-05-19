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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resources([
    'medications' => 'MedicationController',
    'users' => 'UserController',
    'pictures' => 'PictureController',
    'warnings' => 'WarningController',
    'reminders' => 'ReminderController'
]);

Route::group([
    'prefix' => 'users'
], function () {
    Route::get('/{user}/medications', 'UserController@userMedications');
    Route::get('/{user}/reminders', 'UserController@userReminders');
});

Route::group([
    'prefix' => 'medications'
], function () {
    Route::get('/{medication}/reminders', 'MedicationController@medicationReminders');
});
