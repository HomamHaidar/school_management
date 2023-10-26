<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Student;

class GraduatedRepository implements GraduatedRepositoryInterface
{

    public function index()
    {
        $students=Student::onlyTrashed()->get();
        return view('pages.Student.Graduated.index',compact('students'));
    }

    public function create()
    {
        $Grades=Grade::all();
        return view('pages.Student.Graduated.create',compact('Grades'));
    }

    public function SoftDelete($request)
    {
        try {
            $students=Student::where("Grade_id",$request->Grade_id)->where("Classroom_id",$request->Classroom_id)->where("section_id",$request->section_id)->get();
            if ($students->count()==0){
                noty()->addError(trans('messages.no_student_founded'));
                return redirect()->back();
            }
                foreach ($students as $student){
                    $ids=explode(',',$student->id);
                    Student::wherein("id",$ids)->delete();

                }
                noty()->addSuccess(trans('messages.success'));
                return redirect()->back();


        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function RestoreStudent($request)
    {
       Student::where('id',$request->id)->restore();
        noty()->addSuccess(trans('messages.success'));
        return redirect()->back();

    }

    public function DeleteStudent($request)
    {

        Student::onlyTrashed()->where('id',$request->id)->forceDelete();
        noty()->addError(trans('messages.Delete'));
        return redirect()->back();
    }

    public function SoftDelete_one_student($id)
    {
      Student::where('id',$id)->delete();
        noty()->addSuccess(trans('messages.success'));
        return redirect()->back();
    }
}
