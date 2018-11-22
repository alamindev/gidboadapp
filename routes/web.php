<?php
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

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

Auth::routes();
Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::post('/roles/permission/store', 'RoleController@showPermission')->name('database_user_store');
    Route::resource('permissions', 'PermissionController');
    Route::get('permissions/delete/{id}', 'PermissionController@destroy')->name('permissions.delete');
    Route::resource('fuels', 'FuelController');
    Route::get('fuels/delete/{id}', 'FuelController@destroy')->name('fuels.delete');
    Route::resource('manuals', 'ManualCapController');
    Route::get('manuals/delete/{id}', 'ManualCapController@destroy')->name('manuals.delete');

    Route::resource('powers', 'PowerPlantController');
    Route::get('powers/delete/{id}', 'PowerPlantController@destroy')->name('powers.delete');

    Route::resource('distributions', 'DistributionController');
    Route::get('distributions/delete/{id}', 'DistributionController@destroy')->name('distributions.delete');

//power infos
    Route::resource('power-info', 'PowerInfoController');
    Route::get('power-info/create/{id?}', 'PowerInfoController@create')->name('power-info.create');
    Route::get('power-info/delete/{id}', 'PowerInfoController@destroy')->name('power-info.delete');
    //distribution infos
    Route::resource('distributions-info', 'DistributionInfoController');
    Route::get('distributions-info/create/{id?}', 'DistributionInfoController@create')->name('distributions-info.create');
    Route::get('distributions-info/delete/{id}', 'DistributionInfoController@destroy')->name('distributions-info.delete');
    // coding for slider
    Route::resource('slider', 'SliderController');
    Route::get('slider/delete/{id}', 'SliderController@destroy')->name('slider.delete');

    Route::resource('general-setting', 'GeneralController');

    Route::resource('map-info', 'MapController');
    Route::get('map-info/delete/{id}', 'MapController@destroy')->name('map-info.delete');
    Route::resource('map-option', 'MapOptionController');
    Route::resource('total-capacity', 'TotalCapController');
    Route::resource('howtos', 'HowToController');
    Route::resource('howtos', 'HowToController');
});
 
 //for fronend route
Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/getfules', 'HomeController@getFuels')->name('get.fuels');
Route::get('/powerplant/{id}', 'HomeController@getPowerPlant')->name('get.power.plant');
Route::get('/distribution', 'HomeController@Distribution')->name('get.distribution');
Route::get('/powerplant/info/{id}', 'HomeController@PowerPlantInfo')->name('get.PowerPlantInfo');
Route::get('/calculation', 'HomeController@Calculation')->name('Calculation');
 //start coding for map
Route::get('/plant-map', 'HomeController@Map')->name('get.map');
Route::get('/plant-map/fuel', 'HomeController@MapFuel')->name('get.map-fuel');
Route::get('/plant-map/option', 'HomeController@MapOption')->name('get.map-option');
Route::get('/plant-map/map/{id}', 'HomeController@mapById')->name('get.map.id');

 // start cdoing for generation route
Route::get('generation-demand', 'HomeController@Generation')->name('get.generation');
Route::get('todays-data', 'HomeController@Trends')->name('get.trends');
Route::get('todays-trends/tempfuel', 'HomeController@tempFuel')->name('get.tempFuel');


Route::get('carbon-emissions', 'HomeController@CarbonEmission')->name('get.CarbonEmission');
Route::get('installed-capacity', 'HomeController@totalCapacity')->name('get.totalCapacity');
Route::get('power-value-chain', 'HomeController@HowItWork')->name('get.HowItWork');
Route::get('help-and-about', 'HomeController@HelpAbout')->name('get.HelpAbout');
Route::get('total-capacity/chart', 'HomeController@CapacityChart')->name('get.capchart');
 // start coding for distribution show route
Route::get('/distribution/info/{id}', 'HomeController@DistributionInfo')->name('get.distributionInfo');