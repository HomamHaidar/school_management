<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use Exception;

class SubjectRepository implements SubjectRepositoryInterface
{

    public function index()
    {
        $subjects = Subject::all();
        return view('pages.Subjects.index', compact('subjects'));
    }

    public function create()
    {
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Subjects.create', compact('grades', 'teachers'));
    }

    public function store($request)
    {
        try {

            $subjects = new Subject();
            $subjects->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $subjects->grade_id = $request->Grade_id;
            $subjects->classroom_id = $request->Class_id;
            $subjects->teacher_id = $request->teacher_id;
            $subjects->save();

            noty()->addSuccess(trans('messages.success'));
            return redirect()->route('Subjects.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $subject=Subject::findOrFail($id);
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Subjects.edit',compact('subject','grades','teachers'));
    }

    public function update($request)
    {
        try {
        $subject = Subject::findOrFail($request->id);
        $subject->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
        $subject->grade_id = $request->Grade_id;
        $subject->classroom_id = $request->Class_id;
        $subject->teacher_id = $request->teacher_id;
        $subject->save();
        noty()->addInfo(trans('messages.Update'));
        return redirect()->route('Subjects.index');
    } catch (Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

    }

    public function destroy($request)
    {
        Subject::destroy($request->id);
        noty()->addError(trans('messages.Delete'));
        return redirect()->back();
    }
}
