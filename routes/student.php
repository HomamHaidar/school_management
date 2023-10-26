<?php

use App\Http\Controllers\Student\dashboard\ExamController;
use App\Http\Controllers\Student\dashboard\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ],function () {
    //--------------------------------dashboard------------------------------------------------------------
    Route::get('/student/dashboard',function (){

        return view('pages.Student.dashboard');

    })->name('dashboard.student');
    Route::resource('student_exam',ExamController::class);
    Route::resource('student_profile',ProfileController::class);
    Route::get('show_book', [ExamController::class,'show_book'])->name('show_book');
    Route::get('download_book\{fileName}', [ExamController::class,'Download_book'])->name('download.book');

});
