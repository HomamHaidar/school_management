<?php

use App\Http\Controllers\Parent\dashboard\ChildrenController;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| parent Routes
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ], function () {

    //-------------------------------------------dashboard------------------------------------------------------------//
    Route::get('/parent/dashboard', function () {
        $sons=Student::where('parent_id',auth()->user()->id)->get();
        return view('pages.parent.dashboard',compact('sons'));


    })->name('dashboard.parents');

        Route::get("children",[ChildrenController::class,'index'])->name('sons.index');
        Route::get("sons_results/{id}",[ChildrenController::class,'sons_results'])->name('sons.results');
        Route::get('attendance_parent',[ChildrenController::class,'attendance'])->name('attendance.parent');
        Route::match(['get', 'post'],'sons_attendance_search',[ChildrenController::class,'attendance_search'])->name('sons.attendance.search');
        Route::get('fees_parent',[ChildrenController::class,'fees'])->name('fees.parent');
        Route::get('sons_receipt/{id}',[ChildrenController::class,'sons_receipt'])->name('sons.receipt');
        Route::get('parent_profile',[ChildrenController::class,'parent_profile'])->name('parent.profile');
        Route::post('profile_update_parent',[ChildrenController::class,'parent_update'])->name('profile.update.parent');
});
