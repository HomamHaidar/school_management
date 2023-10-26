<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Sections;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class   StudentController extends Controller
{

    public function index()
    {
//        $ids=Teacher::findOrFail(auth()->user()->id)->sections()->pluck('section_id');
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();
        return view('pages.Teachers.dashboard.students.index', compact('students'));
    }


    public function create()
    {
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
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

    public function sections_index()
    {

        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $sections = Sections::whereIn('id', $ids)->get();
        return view('pages.Teachers.dashboard.sections.index', compact('sections'));
    }

    public function attendance(Request $request)
    {
        try {
            foreach ($request->attendences as $s => $attendences) {

                if ($attendences == "presence") {
                    $attendence_status = true;
                } else {
                    $attendence_status = false;
                }

                Attendance::updateOrCreate(['student_id'=>$s,'attendence_date'=>date('Y-m-d')],
                    [
                    'student_id' => $s,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => auth()->user()->id,
                    'attendence_date' => date('Y-m-d'),
                    'attendence_status' => $attendence_status
                ]);


            }
            noty()->addSuccess(trans('messages.success'));
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


 /**
   public function attendance_edit(Request $request)

    {
        try {
            $date = date('Y-m-d');
            $student = Attendance::where('attendence_date',$date)->where('student_id', $request->id)->first();
            if ($request->attendences == 'presence') {
                $attend = true;
            } else {
                $attend =false;
            }
            $student->update([
                'attendence_status' => $attend
            ]);
            noty()->addInfo(trans('messages.Update'));
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
  */

 public function attendance_report()
 {

     $ids=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
     $students=Student::whereIn('section_id',$ids)->get();
     return view('pages.Teachers.dashboard.students.attendance_report',compact('students'));
 }
 public function attendance_search(Request $request)
 {
     $request->validate([
         'from'=>'required|date|date_format:Y-m-d',
         'to'=>'required|date|date_format:Y-m-d|after_or_equal:from'
     ],[
         'from.date_format'=>'yy-mm-d',
         'from.required'=>'form مطلوب ',
         'to.date_format'=>'yy-mm-d',
         'to.required'=>'to مطلوب ',
         'to.after_or_equal'=>'تاريخ البداية اكبراو يساوي النهاية',

     ]);

     $ids=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
     $students=Student::whereIn('section_id',$ids)->get();

        if ($request->student_id==0){
            $student_report=Attendance::whereBetween('attendence_date',[$request->from,$request->to])->get();
            return view('pages.Teachers.dashboard.students.attendance_report',compact('students','student_report'));
        }
        else{
            $student_report=Attendance::whereBetween('attendence_date',[$request->from,$request->to])->where('student_id',$request->student_id )->get();
            return view('pages.Teachers.dashboard.students.attendance_report',compact('students','student_report'));
        }
 }

}
