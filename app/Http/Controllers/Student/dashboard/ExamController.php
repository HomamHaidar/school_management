<?php

namespace App\Http\Controllers\Student\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Library;
use App\Models\Quizze;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{

    public function index()
    {

        $quizzes = Quizze::where('grade_id', auth()->user()->Grade_id)
            ->where('classroom_id', auth()->user()->Classroom_id)
            ->where('section_id', auth()->user()->section_id)
            ->orderBy('id', 'DESC')
            ->get();
        $index=0;
        return view('pages.Student.dashboard.exams.index', compact('quizzes', 'index'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($quizze_id_controller)
    {
        $student_id_controller = Auth::user()->id;
        return view('pages.Student.dashboard.exams.show', compact('student_id_controller', 'quizze_id_controller'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function show_book(){
        $books=Library::all();
        return view('pages.Student.dashboard.library.index',compact('books'));
    }
    public function Download_book($fileName){
        return response()->download(public_path('attachments/library/'.$fileName));
    }
}
