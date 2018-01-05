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

Route::get('admin/{a?}', function () {
    return view('admin.index');
})->middleware('auth');

Route::get('views/{view}', function($view){
    return view('admin.templates.'.$view);
});

Route::group([
    'prefix' => 'rsc',
    'middleware' => 'auth'
], function () {
    Route::get('session', function(){dd(session()->all());});
    Route::put('areas/set-area', 'AreasController@SetArea');
    Route::put('areas/get-area', 'AreasController@GetArea');
    Route::resource('areas', 'AreasController');
    Route::resource('inputs', 'Admin\InputsController');
    Route::resource('outputs', 'Admin\OutputsController');
    Route::resource('reasons', 'Admin\ReasonsController');
    Route::resource('budgets', 'Admin\BudgetsController');
    Route::resource('sources', 'Admin\SourcesController');
    Route::get('users', 'UsersController@index');
});
