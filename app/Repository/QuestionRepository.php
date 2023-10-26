<?php

namespace App\Repository;

use App\Models\Question;
use App\Models\Quizze;
use Exception;

class QuestionRepository implements QuestionRepositoryInterface
{

    public function index()
    {

        $questions = Question::all();
        return view("pages.Question.index", compact('questions'));
    }

    public function create()
    {
        $quizzes = Quizze::all();
        return view('pages.Question.create', compact('quizzes'));
    }

    public function edit($id)
    {
        $question=Question::findOrFail($id);
        $quizzes=Quizze::all();

        return view('pages.Question.Edit',compact('question','quizzes'));
    }

    public function store($request)
    {
        try {
            $question=new Question();
            $question->title=$request->title;
            $question->answers=$request->answers;
            $question->right_answer=$request->right_answer;
            $question->score=$request->score;
            $question->quizze_id=$request->quizze_id;
            $question->save();

            noty()->addSuccess(trans('messages.success'));
            return redirect()->route('Question_admin.index');

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        try {
            $question=Question::findOrFail($request->id);
            $question->title=$request->title;
            $question->answers=$request->answers;
            $question->right_answer=$request->right_answer;
            $question->score=$request->score;
            $question->quizze_id=$request->quizze_id;

            $question->save();

            noty()->addInfo(trans('messages.Update'));
            return redirect()->route('Question_admin.index');

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        Question::destroy($request->id);
        noty()->addError(trans('messages.Delete'));
        return redirect()->back();
    }
}
