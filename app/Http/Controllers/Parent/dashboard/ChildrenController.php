<?php

namespace App\Http\Controllers\Parent\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Degree;
use App\Models\Fee_invoices;
use App\Models\My_Parent;
use App\Models\ReceiptStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChildrenController extends Controller
{
    public function index()
    {
        $students = Student::where('parent_id', auth()->user()->id)->get();
        return view('pages.parent.Son.index', compact('students'));
    }

    public function sons_results($id)
    {
        $students = Student::findOrFail($id);

        if ($students->parent_id != auth()->user()->id) {
            abort('404');
        }
        $degrees = Degree::where('student_id', $id)->get();
        return view('pages.parent.degree.index', compact('degrees'));
    }

    public function attendance()
    {

        $students = Student::where('parent_id', auth()->user()->id)->get();
        return view('pages.parent.Attendance.index', compact('students'));
    }

    public function attendance_search(Request $request)
    {
        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'from.date_format' => 'yy-mm-d',
            'from.required' => 'form مطلوب ',
            'to.date_format' => 'yy-mm-d',
            'to.required' => 'to مطلوب ',
            'to.after_or_equal' => 'تاريخ البداية اكبراو يساوي النهاية',

        ]);

        $ids = DB::table('teacher_section')
            ->where('teacher_id', auth()->user()->id)
            ->pluck('section_id');

        $students_id = Student::whereIn('section_id', $ids)->where('parent_id', auth()->user()->id)->pluck('id');
        $students = Student::where('parent_id', auth()->user()->id)->whereIn('section_id', $ids)->get();


        if ($request->student_id == 0) {

            $student_report = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->whereIn('student_id', $students_id)->get();
            return view('pages.parent.Attendance.index', compact('students', 'student_report'));
        } else {

            $student_report = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->where('student_id', $request->student_id)->get();

            return view('pages.parent.Attendance.index', compact('students', 'student_report'));
        }

    }

    public function fees()
    {
        $student=Student::where('parent_id',auth()->user()->id)->pluck('id');
        $Fee_invoices= Fee_invoices::whereIn('student_id',$student)->get();
        return view('pages.parent.fee.index',compact('Fee_invoices'));
    }

    public function sons_receipt($id){
        $students = Student::findOrFail($id);

        if ($students->parent_id != auth()->user()->id) {
            abort('404');
        }
        $receipt_students=ReceiptStudent::where('student_id',$id)->get();
        return view('pages.parent.Receipt.index',compact('receipt_students'));
    }

    public function parent_profile(){
        $information=My_Parent::findOrFail(auth()->user()->id);
            return view('pages.parent.profile',compact('information'));
    }
    public function parent_update(Request $request){

        $information = My_Parent::findorFail(auth()->user()->id);

        if (!empty($request->password)) {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        noty()->addSuccess(trans('messages.success'));;
        return redirect()->back();

    }
}
