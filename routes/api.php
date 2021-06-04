<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(["prefix"=>"sermons"],function (){
    Route::get('/search/{query}','App\Http\Controllers\SermonController@search');
    Route::get('/','App\Http\Controllers\SermonController@index');
    Route::get('/get/{timestamp}','App\Http\Controllers\SermonController@getLatest');
    Route::get('/{slug}','App\Http\Controllers\SermonController@show');
    Route::post('/','App\Http\Controllers\SermonController@store');
    Route::post('/{slug}','App\Http\Controllers\SermonController@update');
    Route::delete('/{slug}','App\Http\Controllers\SermonController@destroy');
});

Route::group(["prefix"=>"authors"],function (){
    Route::get('/','App\Http\Controllers\AuthorController@index');
    Route::get('/{slug}','App\Http\Controllers\AuthorController@show');
    Route::post('/','App\Http\Controllers\AuthorController@store');
    Route::post('/{slug}','App\Http\Controllers\AuthorController@update');
    Route::delete('/{slug}','App\Http\Controllers\AuthorController@destroy');
});

Route::group(["prefix"=>"series"],function (){
    Route::get('/','App\Http\Controllers\SeriesController@index');
    Route::get('/{slug}','App\Http\Controllers\SeriesController@show');
    Route::post('/','App\Http\Controllers\SeriesController@store');
    Route::post('/{slug}','App\Http\Controllers\SeriesController@update');
    Route::delete('/{slug}','App\Http\Controllers\SeriesController@destroy');
});

Route::group(["prefix"=>"categories"],function (){
    Route::get('/','App\Http\Controllers\CategoryController@index');
    Route::get('/{slug}','App\Http\Controllers\CategoryController@show');
    Route::post('/','App\Http\Controllers\CategoryController@store');
    Route::post('/{slug}','App\Http\Controllers\CategoryController@update');
    Route::delete('/{slug}','App\Http\Controllers\CategoryController@destroy');
});

Route::group(["prefix"=>"themes"],function (){
    Route::get('/','App\Http\Controllers\ThemeController@index');
    Route::get('/{slug}','App\Http\Controllers\ThemeController@show');
    Route::post('/','App\Http\Controllers\ThemeController@store');
    Route::post('/{slug}','App\Http\Controllers\ThemeController@update');
    Route::delete('/{slug}','App\Http\Controllers\ThemeController@destroy');
});
