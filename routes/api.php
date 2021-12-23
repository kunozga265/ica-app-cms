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
    Route::get('/get/{author_id}/{category}/{sort}/{fromDate}/{endDate}','App\Http\Controllers\SermonController@getSermons');
    Route::get('/scheduled','App\Http\Controllers\SermonController@getScheduled');
    Route::get('/filter/{filter}/{query}','App\Http\Controllers\SermonController@getFiltered');
//    Route::get('/views','App\Http\Controllers\SermonController@getViews');
    Route::get('/view/{slug}','App\Http\Controllers\SermonController@show');
    Route::post('/','App\Http\Controllers\SermonController@store');
    Route::post('/{slug}','App\Http\Controllers\SermonController@update');
    Route::post('/upload/image','App\Http\Controllers\SermonController@uploadImage');
    Route::delete('/trash/{slug}','App\Http\Controllers\SermonController@trash');
    Route::delete('/restore/{slug}','App\Http\Controllers\SermonController@restore');
    Route::delete('/destroy/{slug}','App\Http\Controllers\SermonController@destroy');
});

Route::group(["prefix"=>"authors"],function (){
    Route::get('/','App\Http\Controllers\AuthorController@index');
    Route::get('/filter/{filter}/{query}','App\Http\Controllers\AuthorController@getFiltered');
    Route::get('/{slug}','App\Http\Controllers\AuthorController@show');
    Route::get('/{slug}/sermons','App\Http\Controllers\AuthorController@getSermonsByAuthor');
    Route::post('/','App\Http\Controllers\AuthorController@store');
    Route::post('/{slug}','App\Http\Controllers\AuthorController@update');
    Route::delete('/trash/{slug}','App\Http\Controllers\AuthorController@trash');
    Route::delete('/restore/{slug}','App\Http\Controllers\AuthorController@restore');
    Route::delete('/destroy/{slug}','App\Http\Controllers\AuthorController@destroy');
});

Route::group(["prefix"=>"series"],function (){
    Route::get('/search/{query}','App\Http\Controllers\SeriesController@search');
    Route::get('/','App\Http\Controllers\SeriesController@index');
    Route::get('/filter/{filter}/{query}','App\Http\Controllers\SeriesController@getFiltered');
    Route::get('/options','App\Http\Controllers\SeriesController@options');
    Route::get('/view/{slug}/{filter}','App\Http\Controllers\SeriesController@show');
    Route::post('/','App\Http\Controllers\SeriesController@store');
    Route::post('/{slug}','App\Http\Controllers\SeriesController@update');
    Route::delete('/trash/{slug}','App\Http\Controllers\SeriesController@trash');
    Route::delete('/restore/{slug}','App\Http\Controllers\SeriesController@restore');
    Route::delete('/destroy/{slug}','App\Http\Controllers\SeriesController@destroy');
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
