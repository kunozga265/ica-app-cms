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

Route::group(["prefix"=>"1.0.0"],function (){

    Route::post('/seeder',[\App\Http\Controllers\API\V1_0_0\AppController::class, 'seeder']);

    /* Home Page */
    Route::get('/dashboard',[\App\Http\Controllers\API\V1_0_0\AppController::class, 'dashboard']);

    /* Sermons */
    Route::group(["prefix"=>"sermons"],function () {
        Route::get('/search/{query}', [\App\Http\Controllers\API\V1_0_0\SermonController::class, 'search']);
        Route::get('/', [\App\Http\Controllers\API\V1_0_0\SermonController::class, 'index']);
        Route::get('/series/{slug}', [\App\Http\Controllers\API\V1_0_0\SermonController::class, 'bySeries']);
        Route::get('/authors/{slug}', [\App\Http\Controllers\API\V1_0_0\SermonController::class, 'getSermonsByAuthor']);
        Route::post('/',[\App\Http\Controllers\API\V1_0_0\SermonController::class,'store']);
    });

    /* Series */
    Route::group(["prefix"=>"series"],function () {
        Route::get('/search/{query}', [\App\Http\Controllers\API\V1_0_0\SeriesController::class, 'search']);
        Route::get('/', [\App\Http\Controllers\API\V1_0_0\SeriesController::class, 'index']);
    });

    /* Authors */
    Route::group(["prefix"=>"authors"],function () {
        Route::get('/', [\App\Http\Controllers\API\V1_0_0\AuthorController::class, 'index']);
    });

    /* Prayers */
    Route::group(["prefix"=>"prayers"],function (){
        Route::get('/',[\App\Http\Controllers\API\V1_0_0\PrayerController::class, 'index']);
    });
});

Route::group(["prefix"=>"1.1"],function (){

    Route::post('/seeder',[\App\Http\Controllers\API\V1_1\AppController::class, 'seeder']);

    /* Home Page */
    Route::get('/initiate',[\App\Http\Controllers\API\V1_1\AppController::class, 'initiate']);
    Route::get('/dashboard/{timestamp}',[\App\Http\Controllers\API\V1_1\AppController::class, 'dashboard']);
    Route::get('/search/{query}', [\App\Http\Controllers\API\V1_1\AppController::class, 'search']);

    /* Sermons */
    Route::group(["prefix"=>"sermons"],function () {
        Route::get('/', [\App\Http\Controllers\API\V1_1\SermonController::class, 'index']);
        Route::get('/get/{timestamp}', [\App\Http\Controllers\API\V1_1\SermonController::class, 'getSermons']);
        Route::get('/series/{slug}', [\App\Http\Controllers\API\V1_1\SermonController::class, 'bySeries']);
        Route::get('/authors/{slug}', [\App\Http\Controllers\API\V1_1\SermonController::class, 'getSermonsByAuthor']);
    });


    /* Prayers */
    Route::group(["prefix"=>"prayers"],function (){
        Route::get('/',[\App\Http\Controllers\API\V1_1\PrayerController::class, 'index']);
    });

    /* Downloads */
    Route::group(["prefix"=>"downloads"],function (){
        Route::get('/',[\App\Http\Controllers\API\V1_1\DownloadController::class, 'index']);
    });

    Route::get('/twitter',[\App\Http\Controllers\API\V1_1\TwitterController::class, 'index']);
});

