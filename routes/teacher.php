<?php


use App\Http\Controllers\Teachers\dashboard\ProfileController;
use App\Http\Controllers\Teachers\dashboard\QuestionController;
use App\Http\Controllers\Teachers\dashboard\QuizzeController;
use App\Http\Controllers\Teachers\dashboard\StudentController;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| teacher Routes
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //-------------------------------------------dashboard------------------------------------------------------------//
    Route::get('/teacher/dashboard', function () {


            $ids = Teacher::findOrFail(auth()->user()->id)->sections()->pluck('section_id');
            $section_count = $ids->count();
            $students_count = Student::whereIn('section_id', $ids)->count();


        return view('pages.Teachers.dashboard.dashboard', compact('section_count', 'students_count','ids'));
    });


    Route::get('students',[StudentController::class,'index'])->name('students.index') ;
    Route::get('sections',[StudentController::class,'sections_index'])->name('sections');

  //-------------------------------------attendance-------------------------------------------------------//

    Route::post('attendance',[StudentController::class,'attendance'])->name('attendance');
    Route::post('attendance_edit',[StudentController::class,'attendance_edit'])->name('attendance.edit');
    Route::get('attendance_report',[StudentController::class,'attendance_report'])->name('attendance.report');
    Route::match(['get', 'post'],'attendance_search',[StudentController::class,'attendance_search'])->name('attendance.search');

    //---------------------------------Quizzes---------------------------------------------------------//
    Route::resource('Quizzes', QuizzeController::class);
    Route::resource('Question', QuestionController::class);
    Route::get('student_quizze/{id}',[QuestionController::class,'student_quizze'])->name('student.quizze');
    Route::Post('repeat_quizze/',[QuestionController::class,'repeat_quizze'])->name('repeat.quizze');

    //---------------------------------Profile------------------------------------------------------//
    Route::get('Profile',[ProfileController::class,'index'])->name('profile.show');
    Route::post('Profile/{id}',[ProfileController::class,'update'])->name('profile.update');

 });






