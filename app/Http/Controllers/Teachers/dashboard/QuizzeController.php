<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quizze;
use App\Models\Sections;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class QuizzeController extends Controller
{

    public function index()
    {
        $quizzes = Quizze::where('teacher_id', auth()->user()->id)->get();
        return view('pages.Teachers.dashboard.Quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $subjects = Subject::where('teacher_id', auth()->user()->id)->get();
        $grades = Grade::all();
        return view('pages.Teachers.dashboard.Quizzes.create', compact('subjects', 'grades'));
    }


    public function store(Request $request)
    {
        try {
            $quizze = new Quizze();
            $quizze->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizze->subject_id = $request->subject_id;
            $quizze->grade_id = $request->Grade_id;
            $quizze->classroom_id = $request->Classroom_id;
            $quizze->section_id = $request->section_id;
            $quizze->teacher_id = auth()->user()->id;

            $quizze->save();

            noty()->addSuccess(trans('messages.success'));
            return redirect()->route('Quizzes.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        $quizz=Quizze::findOrFail($id);
        $questions=Question::where('quizze_id',$id)->get();
        return view('pages.Teachers.dashboard.Questions.index',compact('quizz','questions'));
    }


    public function edit($id)
    {
        $quizz=Quizze::findOrFail($id);
        $subjects=Subject::all();
        $grades=Grade::all();
        return view('pages.Teachers.dashboard.Quizzes.edit',compact('quizz','subjects','grades'));
    }


    public function update(Request $request)
    {
        try {
            $quizze =Quizze::findOrFail($request->id);
            $quizze->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizze->subject_id = $request->subject_id;
            $quizze->grade_id = $request->Grade_id;
            $quizze->classroom_id = $request->Classroom_id;
            $quizze->section_id = $request->section_id;
            $quizze->teacher_id = auth()->user()->id;
            $quizze->save();

            noty()->addInfo(trans('messages.Update'));
            return redirect()->route('Quizzes.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        Quizze::destroy($request->id);
        noty()->addError(trans('messages.Delete'));
        return redirect()->back();
    }

  /**  public function Get_classrooms($id)
    {
        $list_class = Classroom::where('Grade_id', $id)->pluck('Name_Class', 'id');
        return $list_class;
    }
    public function Get_Sections($id){
        $teacher_id=Teacher::findOrFail(auth()->user()->id)->sections()->pluck('section_id');

        $list_sections=Sections::whereIn('id',$teacher_id)->where('class_id',$id)->pluck('Name_Section','id');
        return $list_sections;
    }

*/
}
