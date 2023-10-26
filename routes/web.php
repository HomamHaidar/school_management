<?php


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Classroom\ClassroomController;

use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Quizze\QuizzeController;
use App\Http\Controllers\Sections\SectionsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Student\AttendanceController;
use App\Http\Controllers\Student\FeesController;
use App\Http\Controllers\Student\FeesInvoicesController;
use App\Http\Controllers\Student\GraduatedController;
use App\Http\Controllers\Student\LibraryController;
use App\Http\Controllers\Student\OnlineClassController;
use App\Http\Controllers\Student\PaymentController;
use App\Http\Controllers\Student\ProcessingFeeController;
use App\Http\Controllers\Student\PromotionController;
use App\Http\Controllers\Student\ReceiptStudentsController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Http\Livewire\Calendar;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;


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


// routes/web.php
//Auth::routes();



//Route::group(['middleware' => ['guest']], function () {
//    Route::get('/', function () {
//        return view('auth.login');
//    });
//});]/



Route::get('/',[HomeController::class,'index'])->name('selection');


Route::group(['namespace' => 'Auth'], function () {
    Route::get('/login/{type}', [LoginController::class, 'loginForm'])->middleware('guest')->name('login.show');
    Route::post('/login',[LoginController::class,'login'])->name('login');
    Route::get('/logout/{type}', [LoginController::class, 'logout'])->name('logout');


});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    //-----------------------------grades-------------------------------------//
    Route::resource('grade', GradeController::class);

    //-----------------------------class-------------------------------------//

    Route::resource('classrooms', ClassroomController::class);
    Route::post('delete_all', [ClassroomController::class, 'delete_all'])->name('delete_all');
    Route::match(['get', 'post'], 'Filter_Classes', [ClassroomController::class, 'fillter_class'])->name('Filter_Classes');


    //-----------------------------sections-------------------------------------//

    Route::resource('Sections', SectionsController::class);
    Route::get('/classes/{id}', [SectionsController::class, 'getclasses']);

    //-----------------------------Teachers-------------------------------------//


    Route::resource('Teachers', TeacherController::class);

    //-----------------------------parents-------------------------------------//

    Route::view('add_parent', 'livewire.show_form')->name('add_parent');

    //-----------------------------students-------------------------------------//
    Route::resource('Students', StudentController::class);
    Route::post('Upload_attachment', [StudentController::class, 'Upload_attachment'])->name('Upload_attachment');
    Route::get('Download_attachment/{student_id}/{file_name}', [StudentController::class, 'Download_attachment'])->name('Download_attachment');
    Route::post('Delete_attachment/', [StudentController::class, 'Delete_attachment'])->name('Delete_attachment');
    Route::resource('Promotions', PromotionController::class);
    Route::resource('Graduated', GraduatedController::class);
    Route::resource('Fees', FeesController::class);
    Route::resource('Fees_invoices', FeesInvoicesController::class);
    Route::resource('Receipt_Students', ReceiptStudentsController::class);
    Route::resource('Processing_Fee', ProcessingFeeController::class);
    Route::resource('Payment_Students', PaymentController::class);
    Route::resource('Payment_Students', PaymentController::class);
    Route::resource('Attendance', AttendanceController::class);
    Route::resource('Library', LibraryController::class);
    Route::get('downloadAttachment\{fileName}', [LibraryController::class,'downloadAttachment'])->name('downloadAttachment');
//    Route::resource('Online_Class', OnlineClassController::class);

    //-----------------------------Subjects-------------------------------------//

    Route::resource('Subjects', SubjectController::class);

  //-----------------------------Quizzes-------------------------------------//

    Route::resource('Quizzes_admin', QuizzeController::class);
 //-----------------------------Question-------------------------------------//

    Route::resource('Question_admin', QuestionController::class);
 //-----------------------------Setting-------------------------------------//

    Route::resource('Setting', SettingController::class);

    Livewire::component('calendar', Calendar::class);

    });





