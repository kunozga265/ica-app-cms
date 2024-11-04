<?php

use App\Http\Controllers\Web;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

Route::get('/', [Web\Guest\PageController::class,"home",])->name('home');
Route::get('/sermons/{slug}', [Web\Guest\PageController::class,"sermon",])->name('sermon');


Route::group(['middleware'=>'auth'],function (){

    Route::get('/dashboard', function () {
        return Redirect::route('sermons.index');
    })->name('dashboard');


    Route::group(['prefix'=>'user'],function(){

        Route::get('/change-password',[
            Web\AppController::class,'changePasswordView'
        ])->name('change.password.view');

        Route::post('/change-password',[
            Web\AppController::class,'changePassword'
        ])->name('change.password');

        Route::post('/link/{id}',[
            Web\UserController::class,'linkMember'
        ])->name('users.link');



        Route::post('/logout', function () {
            Auth::logout();
            return Redirect::route('dashboard');
        })->name('logout');
    });

    Route::group(['prefix'=>'sermons'],function(){

        Route::get('/', [Web\SermonController::class,'index'])->name('sermons.index');
        Route::get('/create', [Web\SermonController::class,'create'])->name('sermons.create');

        Route::get('/{slug}/view', [Web\SermonController::class,'show'])->name('sermons.show');
        Route::post('/store', [Web\SermonController::class,'store'])->name('sermons.store');
        Route::get('/{slug}/edit', [Web\SermonController::class,'edit'])->name('sermons.edit');
        Route::post('/{slug}/update', [Web\SermonController::class,'update'])->name('sermons.update');
        Route::post('/{slug}/delete', [Web\SermonController::class,'trash'])->name('sermons.trash');

    });


    Route::group(['prefix'=>'series'],function(){

        Route::get('/', [Web\SeriesController::class,'index'])->name('series.index');
        Route::get('/create', [Web\SeriesController::class,'create'])->name('series.create');

        Route::get('/{slug}/view', [Web\SeriesController::class,'show'])->name('series.show');
        Route::post('/store', [Web\SeriesController::class,'store'])->name('series.store');
        Route::get('/{slug}/edit', [Web\SeriesController::class,'edit'])->name('series.edit');
        Route::post('/{slug}/update', [Web\SeriesController::class,'update'])->name('series.update');
        Route::post('/{slug}/delete', [Web\SeriesController::class,'trash'])->name('series.trash');

    });


    Route::group(['prefix'=>'ministers'],function(){

        Route::get('/', [Web\AuthorController::class,'index'])->name('authors.index');

        Route::get('/create', [Web\AuthorController::class,'create'])->name('authors.create');
        Route::get('/{slug}/view', [Web\AuthorController::class,'show'])->name('authors.show');
        Route::post('/store', [Web\AuthorController::class,'store'])->name('authors.store');
        Route::get('/{slug}/edit', [Web\AuthorController::class,'edit'])->name('authors.edit');
        Route::post('/{slug}/update', [Web\AuthorController::class,'update'])->name('authors.update');
        Route::post('/{slug}/delete', [Web\AuthorController::class,'trash'])->name('authors.trash');
    });


    Route::group(['prefix'=>'prayers-points'],function(){

        Route::get('/', [Web\PrayerController::class,'index'])->name('prayers.index');
        Route::get('/{id}/view', [Web\PrayerController::class,'show'])->name('prayers.show');

        Route::get('/create', [Web\PrayerController::class,'create'])->name('prayers.create');
        Route::post('/store', [Web\PrayerController::class,'store'])->name('prayers.store');
        Route::get('/{slug}/edit', [Web\PrayerController::class,'edit'])->name('prayers.edit');
        Route::post('/{slug}/update', [Web\PrayerController::class,'update'])->name('prayers.update');
        Route::post('/{slug}/delete', [Web\PrayerController::class,'trash'])->name('prayers.trash');
    });

    Route::group(['prefix'=>'events'],function(){

        Route::get('/', [Web\EventController::class,'index'])->name('events.index');
        Route::get('/{id}/view', [Web\EventController::class,'show'])->name('events.show');

        Route::get('/create', [Web\EventController::class,'create'])->name('events.create');
        Route::post('/store', [Web\EventController::class,'store'])->name('events.store');
        Route::get('/{slug}/edit', [Web\EventController::class,'edit'])->name('events.edit');
        Route::post('/{slug}/update', [Web\EventController::class,'update'])->name('events.update');
        Route::post('/{slug}/delete', [Web\EventController::class,'trash'])->name('events.trash');
    });

    Route::group(['prefix'=>'downloads'],function(){

        Route::get('/', [Web\DownloadController::class,'index'])->name('downloads.index');
//        Route::get('/{id}/view', [Web\DownloadController::class,'show'])->name('downloads.show');

        Route::get('/create', [Web\DownloadController::class,'create'])->name('downloads.create');
        Route::post('/store', [Web\DownloadController::class,'store'])->name('downloads.store');
        Route::get('/{slug}/edit', [Web\DownloadController::class,'edit'])->name('downloads.edit');
        Route::post('/{slug}/update', [Web\DownloadController::class,'update'])->name('downloads.update');
        Route::post('/{slug}/delete', [Web\DownloadController::class,'trash'])->name('downloads.trash');
    });

    Route::group(['prefix'=>'pages'],function(){

        Route::get('/announcements', [Web\PageController::class,'announcements'])->name('pages.announcements');
        Route::get('/fundraising', [Web\PageController::class,'fundraising'])->name('pages.fundraising');
        Route::post('/update', [Web\PageController::class,'store'])->name('pages.update');
    });

    Route::post('/image-upload', [Web\AppController::class, 'imageUpload'])->name('images.upload');

    Route::group(['prefix'=>'members'],function(){
        Route::get('/', [Web\MemberController::class,'index'])->name('members.index');
        Route::get('/{code}/view', [Web\MemberController::class,'show'])->name('members.show');
        Route::get('/create', [Web\MemberController::class,'create'])->name('members.create');
        Route::post('/store', [Web\MemberController::class,'store'])->name('members.store');
        Route::get('/{slug}/edit', [Web\MemberController::class,'edit'])->name('members.edit');
        Route::post('/{slug}/update', [Web\MemberController::class,'update'])->name('members.update');
        Route::post('/{slug}/delete', [Web\MemberController::class,'trash'])->name('members.trash');
        Route::post('/add-to-cell/{code}', [Web\MemberController::class,'addToCell'])->name('members.add-to-cell');
        Route::post('/remove-from-cell/{code}', [Web\MemberController::class,'removeFromCell'])->name('members.remove-from-cell');
        Route::post('/transfer/{code}', [Web\MemberController::class,'transferFromCell'])->name('members.transfer');
        Route::post('/assign-cell/{code}', [Web\MemberController::class,'assignCell'])->name('members.assign-cell');
        Route::post('/attach-ministries/{code}', [Web\MemberController::class,'attachMinistries'])->name('members.attach-ministries');
        Route::post('/link-user/{code}', [Web\MemberController::class,'linkUser'])->name('members.link-user');
    });

    Route::group(['prefix'=>'cells'],function(){

        Route::get('/', [Web\CellController::class,'index'])->name('cells.index');
        Route::get('/{code}/view', [Web\CellController::class,'show'])->name('cells.show');
        Route::get('/create', [Web\CellController::class,'create'])->name('cells.create');
        Route::post('/store', [Web\CellController::class,'store'])->name('cells.store');
        Route::get('/{slug}/edit', [Web\CellController::class,'edit'])->name('cells.edit');
        Route::post('/{slug}/update', [Web\CellController::class,'update'])->name('cells.update');
        Route::post('/{slug}/delete', [Web\CellController::class,'trash'])->name('cells.trash');
        Route::post('/{code}/meeting/create', [Web\MeetingController::class,'store'])->name('cells.create-meeting');
        Route::post('/{code}/meeting/update/{meeting_code}', [Web\MeetingController::class,'update'])->name('cells.update-meeting');
        Route::post('/{code}/meeting/record-attendance/{meeting_code}', [Web\MeetingController::class,'recordAttendance'])->name('cells.record-attendance');
        Route::post('/unset-attendance/{id}', [Web\AttendanceController::class,'unsetAttendance'])->name('cells.unset-attendance');
        Route::post('/{code}/meeting/trash/{meeting_code}', [Web\MeetingController::class,'trash'])->name('cells.trash-meeting');

        Route::get('/{code}/transactions', [Web\TransactionController::class,'index'])->name('cells.transactions');
        Route::post('/{code}/transactions', [Web\TransactionController::class,'store'])->name('cells.store-transaction');
    });

});


require __DIR__.'/auth.php';
