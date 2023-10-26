<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Teacher;


class QuizzeRepository implements QuizzeRepositoryInterface
{


    public function index()
    {
        $quizzes = Quizze::all();
        return view('pages.Quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        $data['grades'] = Grade::all();
        return view('pages.Quizzes.create', $data);
    }

    public function Store($request)
    {
        try {
            $quizze = new Quizze();
            $quizze->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizze->subject_id = $request->subject_id;
            $quizze->grade_id = $request->Grade_id;
            $quizze->classroom_id = $request->Classroom_id;
            $quizze->section_id = $request->section_id;
            $quizze->teacher_id = $request->teacher_id;
            $quizze->save();

            noty()->addSuccess(trans('messages.success'));
            return redirect()->route('Quizzes_admin.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $data['quizz']=Quizze::findOrFail($id);
        $data['subjects']=Subject::all();
        $data['teachers']=Teacher::all();
        $data['grades']=Grade::all();
        return view('pages.Quizzes.edit',$data);
    }

    public function update($request)
    {
        try {
            $quizze =Quizze::findOrFail($request->id);
            $quizze->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizze->subject_id = $request->subject_id;
            $quizze->grade_id = $request->Grade_id;
            $quizze->classroom_id = $request->Classroom_id;
            $quizze->section_id = $request->section_id;
            $quizze->teacher_id = $request->teacher_id;
            $quizze->save();

            noty()->addInfo(trans('messages.Update'));
            return redirect()->route('Quizzes_admin.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        Quizze::destroy($request->id);
        noty()->addError(trans('messages.Delete'));
        return redirect()->back();
    }
}
