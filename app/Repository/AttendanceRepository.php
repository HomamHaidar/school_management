<?php

namespace App\Repository;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Exception;

class AttendanceRepository implements AttendanceRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Attendance.Sections', compact('Grades', 'list_Grades', 'teachers'));
    }

    public function Store($request)
    {

        try {
            foreach ($request->attendences as $s => $attendences) {
                if ($attendences == "presence") {
                    $attendence_status = true;
                } else {
                    $attendence_status = false;
                }
                Attendance::create([
                    'student_id' => $s,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => 1,
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

    public function show($id)
    {


            $students = Student::with(['attendance'])->where('section_id', $id)->get();
        return view('pages.Attendance.index', compact('students'));
    }


}