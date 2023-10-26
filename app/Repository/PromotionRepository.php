<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Exception;
use Illuminate\Support\Facades\DB;

class PromotionRepository implements PromotionRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::all();
        return view('pages.Student.Promotions.index', compact('Grades'));
    }

    public function create()
    {
        $promotions =  Promotion::whereHas('student', function ($query) {
            $query->whereNull('deleted_at');
        })->get();
        return view('pages.Student.Promotions.management', compact('promotions'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {

            $students = student::where('Grade_id', $request->Grade_id)->where('Classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->where('academic_year', $request->academic_year)->get();

            if ($students->count() == 0) {
                noty()->addError(trans('messages.no_student_founded'));
                return redirect()->back();
            }
            foreach ($students as $student) {

                $ids = explode(',', $student->id);
                Student::wherein('id', $ids)
                    ->update([
                        'Grade_id' => $request->Grade_id_new,
                        'Classroom_id' => $request->Classroom_id_new,
                        'section_id' => $request->section_id_new,
                        'academic_year' => $request->academic_year_new
                    ]);
                Promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->Grade_id,
                    'from_Classroom' => $request->Classroom_id,
                    'from_section' => $request->section_id,
                    'academic_year' => $request->academic_year,
                    'to_grade' => $request->Grade_id_new,
                    'to_Classroom' => $request->Classroom_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year_new' => $request->academic_year_new
                ]);
            }

            DB::commit();
            noty()->addSuccess(trans('messages.success'));
            return redirect()->back();


        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }


    public function destroy($request)
    {
        DB::beginTransaction();
        try {

            if ($request->page_id == 1) {
                $promotions = Promotion::all();
                foreach ($promotions as $promotion) {
                    $ids = explode(',', $promotion->student_id);
                    Student::wherein('id', $ids)
                        ->update([
                            'Grade_id' => $promotion->from_grade,
                            'Classroom_id' => $promotion->from_Classroom,
                            'section_id' => $promotion->from_section,
                            'academic_year' => $promotion->academic_year
                        ]);

                    Promotion::truncate();

                }

                DB::commit();
                noty()->addError(trans('messages.Delete'));
                return redirect()->back();
            }
            else {
                    $promotion=Promotion::findOrFail($request->id);

                    Student::where('id',$promotion->student_id)->update([
                        'Grade_id' => $promotion->from_grade,
                        'Classroom_id' => $promotion->from_Classroom,
                        'section_id' => $promotion->from_section,
                        'academic_year' => $promotion->academic_year
                    ]);
                Promotion::destroy($request->id);
                DB::commit();
                noty()->addError(trans('messages.Delete'));
                return redirect()->back();
            }



        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }
}

