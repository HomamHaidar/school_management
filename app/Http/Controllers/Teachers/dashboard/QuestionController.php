<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\Question;
use App\Models\Quizze;
use Exception;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function show($id)
    {
        $quizze_id = $id;
        return view('pages.Teachers.dashboard.Questions.create', compact('quizze_id'));
    }

    public function store(Request $request)
    {

        try {
            $question = new Question();

            $question->title = $request->title;

            $question->answers = $request->answers;

            $question->right_answer = $request->right_answer;

            $question->score = $request->score;

            $question->quizze_id = $request->quizz_id;

            $question->save();

            noty()->addSuccess(trans('messages.success'));
            return redirect()->route('Quizzes.show', $request->quizz_id);

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function edit($id)
    {
        $question=Question::findOrFail($id);
        return view('pages.Teachers.dashboard.Questions.edit',compact('question'));
    }

    public function update(Request $request,$id)
    {

        try {
            $question=Question::findOrFail($id);

            $question->title=$request->title;
            $question->answers=$request->answers;
            $question->right_answer=$request->right_answer;
            $question->score=$request->score;

            $question->save();
            noty()->addInfo(trans('messages.Update'));
            return redirect()->route('Quizzes.show',$request->quizze_id);

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Question::destroy($id);
        noty()->addError(trans('messages.Delete'));
        return redirect()->back();
    }

    public function student_quizze($id){
        $degrees=Degree::where('quizze_id',$id)->get();
        return view('pages.Teachers.dashboard.Quizzes.student_quizze',compact('degrees'));
    }

    public function repeat_quizze(Request $request){
        $degrees=Degree::where('quizze_id',$request->quizze_id)->where('student_id',$request->student_id)->delete();
        noty()->addSuccess(trans('messages.success'));
        return redirect()->back();

    }


}
