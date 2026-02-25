<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;

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

    Route::post('/seeder',[API\V1_0_0\AppController::class, 'seeder']);

    /* Home Page */
    Route::get('/dashboard',[API\V1_0_0\AppController::class, 'dashboard']);

    /* Sermons */
    Route::group(["prefix"=>"sermons"],function () {
        Route::get('/search/{query}', [API\V1_0_0\SermonController::class, 'search']);
        Route::get('/', [API\V1_0_0\SermonController::class, 'index']);
        Route::get('/series/{slug}', [API\V1_0_0\SermonController::class, 'bySeries']);
        Route::get('/authors/{slug}', [API\V1_0_0\SermonController::class, 'getSermonsByAuthor']);
        Route::post('/',[API\V1_0_0\SermonController::class,'store']);
    });

    /* Series */
    Route::group(["prefix"=>"series"],function () {
        Route::get('/search/{query}', [API\V1_0_0\SeriesController::class, 'search']);
        Route::get('/', [API\V1_0_0\SeriesController::class, 'index']);
    });

    /* Authors */
    Route::group(["prefix"=>"authors"],function () {
        Route::get('/', [API\V1_0_0\AuthorController::class, 'index']);
    });

    /* Prayers */
    Route::group(["prefix"=>"prayers"],function (){
        Route::get('/',[API\V1_0_0\PrayerController::class, 'index']);
    });
});

Route::group(["prefix"=>"1.1"],function (){

    Route::post('/seeder',[API\V1_1\AppController::class, 'seeder']);

    /* Home Page */
    Route::get('/initiate',[API\V1_1\AppController::class, 'initiate']);
    Route::get('/dashboard/{timestamp}',[API\V1_1\AppController::class, 'dashboard']);
    Route::get('/search/{query}', [API\V1_1\AppController::class, 'search']);

    /* Sermons */
    Route::group(["prefix"=>"sermons"],function () {
        Route::get('/', [API\V1_1\SermonController::class, 'index']);
        Route::get('/get/{timestamp}', [API\V1_1\SermonController::class, 'getSermons']);
        Route::get('/series/{slug}', [API\V1_1\SermonController::class, 'bySeries']);
        Route::get('/authors/{slug}', [API\V1_1\SermonController::class, 'getSermonsByAuthor']);
    });


    /* Prayers */
    Route::group(["prefix"=>"prayers"],function (){
        Route::get('/',[API\V1_1\PrayerController::class, 'index']);
    });

    /* Downloads */
    Route::group(["prefix"=>"downloads"],function (){
        Route::get('/',[API\V1_1\DownloadController::class, 'index']);
    });

    Route::get('/twitter',[API\V1_1\TwitterController::class, 'index']);
});

Route::group(["prefix"=>"1.2"],function (){

    /* Home Page */
    Route::get('/initiate',[API\V1_1\AppController::class, 'initiate']);
    Route::get('/dashboard/{timestamp}',[API\V1_2\AppController::class, 'dashboard']);
    Route::get('/search/{query}', [API\V1_1\AppController::class, 'search']);

    /* Sermons */
    Route::group(["prefix"=>"sermons"],function () {
        Route::get('/', [API\V1_2\SermonController::class, 'index']);
        Route::get('/get/{timestamp}', [API\V1_2\SermonController::class, 'getSermons']);
        Route::get('/view/{slug}', [API\V1_2\SermonController::class, 'show']);
        Route::get('/series/{slug}', [API\V1_2\SermonController::class, 'bySeries']);
        Route::get('/authors/{slug}', [API\V1_2\SermonController::class, 'getSermonsByAuthor']);
    });

    Route::post('/users/login', [API\V1_2\UserController::class, 'login']);

    Route::group(["prefix"=>"cells", "middleware"=>"auth:sanctum"], function (){
        Route::get('/{code}/get', [API\V1_2\CellController::class, 'show']);
        Route::get('/unverified', [API\V1_2\CellController::class, 'unverified']);
        Route::post('/', [\App\Http\Controllers\Web\CellController::class, 'store']);
        Route::post('/verify', [\App\Http\Controllers\Web\CellController::class, 'verify']);
        Route::post('/meetings', [\App\Http\Controllers\Web\MeetingController::class, 'store']);
    });

    Route::group(["prefix"=>"meetings", "middleware"=>"auth:sanctum"], function (){
        Route::post('/', [\App\Http\Controllers\Web\MeetingController::class, 'store']);
        Route::post('/{code}', [API\V1_2\MeetingController::class, 'update']);
    });

    Route::group(["prefix"=>"meetings", "middleware"=>"auth:sanctum"], function (){
        Route::post('/', [API\V1_2\MeetingController::class, 'store']);
        Route::post('/{code}', [API\V1_2\MeetingController::class, 'update']);
    });

    Route::group(["prefix"=>"members", "middleware"=>"auth:sanctum"], function (){
        Route::post('/', [API\V1_2\MemberController::class, 'store']);
    });

    Route::group(["prefix"=>"transactions", "middleware"=>"auth:sanctum"], function (){
        Route::post('/', [API\V1_2\TransactionController::class, 'store']);
    });

    Route::group(["prefix"=>"highlights", "middleware"=>"auth:sanctum"], function (){
        Route::post('/', [API\V1_2\HighlightController::class, 'store']);
    });

    Route::group(["prefix"=>"data", "middleware"=>"auth:sanctum"], function (){
//        Route::get('/', [API\V1_2\AppController::class, 'authData']);
        Route::post('/', [API\V1_2\AppController::class, 'syncData']);
    });

    /* Downloads */
    Route::group(["prefix"=>"downloads"],function (){
        Route::get('/',[API\V1_1\DownloadController::class, 'index']);
    });

//    Route::post('/notification',[\App\Http\Controllers\Web\NotificationController::class, 'pushNotification']);


});

Route::group(["prefix"=>"1.3"],function (){

    /* Home Page */
    Route::get('/initiate',[API\V1_1\AppController::class, 'initiate']);
    Route::get('/dashboard/{timestamp}',[API\V1_3\AppController::class, 'dashboard']);
    Route::get('/search/{query}', [API\V1_1\AppController::class, 'search']);

    /* Sermons */
    Route::group(["prefix"=>"sermons"],function () {
        Route::get('/', [API\V1_2\SermonController::class, 'index']);
        Route::get('/get/{timestamp}', [API\V1_2\SermonController::class, 'getSermons']);
        Route::get('/view/{slug}', [API\V1_2\SermonController::class, 'show']);
        Route::get('/series/{slug}', [API\V1_2\SermonController::class, 'bySeries']);
        Route::get('/authors/{slug}', [API\V1_2\SermonController::class, 'getSermonsByAuthor']);
    });

    Route::post('/users/login', [API\V1_3\UserController::class, 'login']);

    Route::group(["prefix"=>"cells", "middleware"=>"auth:sanctum"], function (){
        Route::get('/{code}/get', [API\V1_2\CellController::class, 'show']);
        Route::get('/unverified', [API\V1_2\CellController::class, 'unverified']);
        Route::post('/', [\App\Http\Controllers\Web\CellController::class, 'store']);
        Route::post('/verify', [\App\Http\Controllers\Web\CellController::class, 'verify']);
        Route::post('/meetings', [\App\Http\Controllers\Web\MeetingController::class, 'store']);
    });

    Route::group(["prefix"=>"meetings", "middleware"=>"auth:sanctum"], function (){
        Route::post('/', [\App\Http\Controllers\Web\MeetingController::class, 'store']);
        Route::post('/{code}', [API\V1_2\MeetingController::class, 'update']);
    });

    Route::group(["prefix"=>"meetings", "middleware"=>"auth:sanctum"], function (){
        Route::post('/', [API\V1_2\MeetingController::class, 'store']);
        Route::post('/{code}', [API\V1_2\MeetingController::class, 'update']);
    });

    Route::group(["prefix"=>"members", "middleware"=>"auth:sanctum"], function (){
        Route::post('/', [API\V1_3\MemberController::class, 'store']);
    });

    Route::group(["prefix"=>"transactions", "middleware"=>"auth:sanctum"], function (){
        Route::post('/', [API\V1_2\TransactionController::class, 'store']);
    });

    Route::group(["prefix"=>"highlights", "middleware"=>"auth:sanctum"], function (){
        Route::post('/', [API\V1_2\HighlightController::class, 'store']);
    });

    Route::group(["prefix"=>"data", "middleware"=>"auth:sanctum"], function (){
        Route::post('/', [API\V1_3\AppController::class, 'syncData']);
        Route::post('/delete', [API\V1_3\AppController::class, 'deleteData']);
    });

    /* Downloads */
    Route::group(["prefix"=>"downloads"],function (){
        Route::get('/',[API\V1_1\DownloadController::class, 'index']);
    });


    Route::group(["prefix"=>"registers", "middleware"=>"auth:sanctum"], function (){
        Route::get('/', [API\V1_3\RegisterController::class, 'index']);
        Route::post('/', [API\V1_3\RegisterController::class, 'store']);
        Route::get('/{code}/attendance', [API\V1_3\RegisterController::class, 'attendance']);
        Route::post('/attendance', [API\V1_3\RegisterController::class, 'recordAttendance']);
    });

//    Route::post('/notification',[\App\Http\Controllers\Web\NotificationController::class, 'pushNotification']);


});

Route::group(["prefix"=>"1.4"],function (){

    /* Home Page */
    Route::get('/initiate',[API\V1_1\AppController::class, 'initiate']);
    Route::get('/dashboard/{timestamp}',[API\V1_3\AppController::class, 'dashboard']);
    Route::get('/search/{query}', [API\V1_1\AppController::class, 'search']);

    /* Sermons */
    Route::group(["prefix"=>"sermons"],function () {
        Route::get('/', [API\V1_2\SermonController::class, 'index']);
        Route::get('/get/{timestamp}', [API\V1_2\SermonController::class, 'getSermons']);
        Route::get('/view/{slug}', [API\V1_2\SermonController::class, 'show']);
        Route::get('/series/{slug}', [API\V1_2\SermonController::class, 'bySeries']);
        Route::get('/authors/{slug}', [API\V1_2\SermonController::class, 'getSermonsByAuthor']);
    });

    Route::post('/users/login', [API\V1_3\UserController::class, 'login']);
    Route::post('/users/confirm', [API\V1_3\UserController::class, 'confirm']);

    Route::group(["prefix"=>"cells", "middleware"=>"auth:sanctum"], function (){
        Route::get('/{code}/get', [API\V1_2\CellController::class, 'show']);
        Route::get('/unverified', [API\V1_2\CellController::class, 'unverified']);
        Route::post('/', [\App\Http\Controllers\Web\CellController::class, 'store']);
        Route::post('/verify', [\App\Http\Controllers\Web\CellController::class, 'verify']);
        Route::post('/meetings', [\App\Http\Controllers\Web\MeetingController::class, 'store']);
    });

    Route::group(["prefix"=>"meetings", "middleware"=>"auth:sanctum"], function (){
        Route::post('/', [\App\Http\Controllers\Web\MeetingController::class, 'store']);
        Route::post('/{code}', [API\V1_2\MeetingController::class, 'update']);
    });

    Route::group(["prefix"=>"meetings", "middleware"=>"auth:sanctum"], function (){
        Route::post('/', [API\V1_2\MeetingController::class, 'store']);
        Route::post('/{code}', [API\V1_2\MeetingController::class, 'update']);
    });

    Route::group(["prefix"=>"members", "middleware"=>"auth:sanctum"], function (){
        Route::post('/', [API\V1_3\MemberController::class, 'store']);
    });

    Route::group(["prefix"=>"transactions", "middleware"=>"auth:sanctum"], function (){
        Route::post('/', [API\V1_2\TransactionController::class, 'store']);
    });

    Route::group(["prefix"=>"highlights", "middleware"=>"auth:sanctum"], function (){
        Route::post('/', [API\V1_2\HighlightController::class, 'store']);
    });

    Route::group(["prefix"=>"data", "middleware"=>"auth:sanctum"], function (){
        Route::post('/', [API\V1_3\AppController::class, 'syncData']);
        Route::post('/delete', [API\V1_3\AppController::class, 'deleteData']);
    });

    /* Downloads */
    Route::group(["prefix"=>"downloads"],function (){
        Route::get('/',[API\V1_1\DownloadController::class, 'index']);
    });


    Route::group(["prefix"=>"registers", "middleware"=>"auth:sanctum"], function (){
        Route::get('/', [API\V1_3\RegisterController::class, 'index']);
        Route::post('/', [API\V1_3\RegisterController::class, 'store']);
        Route::get('/{code}/attendance', [API\V1_3\RegisterController::class, 'attendance']);
        Route::post('/attendance', [API\V1_3\RegisterController::class, 'recordAttendance']);
        Route::post('/{code}/attendance/self-registration', [API\V1_3\RegisterController::class, 'selfRegistration']);
    });

//    Route::post('/notification',[\App\Http\Controllers\Web\NotificationController::class, 'pushNotification']);


});

