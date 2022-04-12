<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


Route::group(['middleware' => ['auth']], function (){
    Route::resource('roles', 'App\Http\Controllers\RoleController');
    Route::resource('users', 'App\Http\Controllers\UserController');
    Route::resource('countries', 'App\Http\Controllers\CountryController');
    Route::get('countries/movement/{country}', 'App\Http\Controllers\CountryController@movement')->name('countries.movement');
    Route::resource('shippingports', 'App\Http\Controllers\ShippingPortController');
    Route::get('shippingports/movement/{shippingPort}', 'App\Http\Controllers\ShippingPortController@movement')->name('shippingports.movement');
    Route::resource('destinationports', 'App\Http\Controllers\DestinationPortController');
    Route::get('destinationports/movement/{destinationPort}', 'App\Http\Controllers\DestinationPortController@movement')->name('destinationports.movement');
    Route::resource('storagelocations', 'App\Http\Controllers\StorageLocationController');
    Route::get('storagelocations/movement/{storageLocation}', 'App\Http\Controllers\StorageLocationController@movement')->name('storagelocations.movement');
    Route::resource('slaughterplaces', 'App\Http\Controllers\SlaughterplaceController');
    Route::get('slaughterplaces/movement/{slaughterPlace}', 'App\Http\Controllers\SlaughterplaceController@movement')->name('slaughterplaces.movement');
    Route::resource('exporters', 'App\Http\Controllers\ExporterController');
    Route::get('exporters/movement/{exporter}', 'App\Http\Controllers\ExporterController@movement')->name('exporters.movement');
    Route::resource('bordercrossings', 'App\Http\Controllers\BorderCrossingController');
    Route::get('bordercrossings/movement/{borderCrossing}', 'App\Http\Controllers\BorderCrossingController@movement')->name('bordercrossings.movement');
    Route::resource('consignees', 'App\Http\Controllers\ConsigneeController');
    Route::get('consignees/movement/{consignee}', 'App\Http\Controllers\ConsigneeController@movement')->name('consignees.movement');
    Route::resource('neppex', 'App\Http\Controllers\NeppexController');
    Route::get('neppex-last-record', 'App\Http\Controllers\NeppexController@lastrecord')->name('neppex.lastrecord');
    Route::get('neppex-errors', 'App\Http\Controllers\NeppexController@errors')->name('neppex.errors');
    Route::get('neppex-generateexcel/{codaut}', 'App\Http\Controllers\NeppexController@generateExcel')->name('neppex.excel');
    Route::get('neppex-filteredout', 'App\Http\Controllers\NeppexController@filteredout')->name('neppex.filteredout');
    Route::post('neppex-filteredoutstore', 'App\Http\Controllers\NeppexController@filteredoutstore')->name('neppex.filteredoutstore');
    Route::get('neppex-filteredoutbox', 'App\Http\Controllers\NeppexController@filteredoutBox')->name('neppex.filteredoutbox');
    Route::post('neppex-filteredoutboxstore', 'App\Http\Controllers\NeppexController@filteredoutBoxStore')->name('neppex.filteredoutboxstore');
    Route::get('/logs', 'App\Http\Controllers\LogController@errors')->name('logs.errors');
    Route::resource('marketrestrictions', 'App\Http\Controllers\MarketRestrictionController');
    Route::resource('forbiddensubstances', 'App\Http\Controllers\ForbiddenSubstanceController');
    Route::resource('analysisresults', 'App\Http\Controllers\AnalysisResultsController');
    Route::resource('generalbackground', 'App\Http\Controllers\GeneralBackgroundController');
    Route::resource('dispatchguides', 'App\Http\Controllers\DispatchGuideController');
    Route::get('dispatchguides/redirect/{url}/{dispatchguide}', 'App\Http\Controllers\DispatchGuideController@redirect')->name('dispatchguides.redirect');
    Route::get('lots', 'App\Http\Controllers\LotController@index')->name('lots.index');
    Route::get('lots/list', 'App\Http\Controllers\LotController@list')->name('lots.list');
    Route::post('lots/store', 'App\Http\Controllers\LotController@store')->name('lots.store');
    Route::get('lots/assignment/{id}', 'App\Http\Controllers\LotController@create')->name('lots.assignment');
    Route::get('lots/error', 'App\Http\Controllers\LotController@errors')->name('lots.errors');
    Route::resource('places', 'App\Http\Controllers\PlaceController');
    Route::resource('restrictions', 'App\Http\Controllers\RestrictionController');
    Route::resource('laboratories', 'App\Http\Controllers\LaboratoryController');
});
