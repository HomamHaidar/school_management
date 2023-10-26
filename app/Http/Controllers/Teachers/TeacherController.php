<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacher;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Repository\TeacherRepositoryInterface;
class TeacherController extends Controller
{
    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher){
          $this->Teacher=$Teacher;
      }

    public function index()
    {
        $Teachers= $this->Teacher->getAllTeacher();
      return view('pages.Teachers.Teachers', compact('Teachers'));
    }


    public function create()
    {
        $genders=$this->Teacher->getAllGenders();
        $specializations=$this->Teacher->getAllSpecializations();
        return view('pages.Teachers.create',compact('genders','specializations'));
    }


    public function store(StoreTeacher $request)
    {
        return $this->Teacher->StoreTeacher($request);
    }


    public function show(Teacher $teacher)
    {
        //
    }



    public function edit($id)
    {
        $Teachers=$this->Teacher->EditTeacher($id);
        $specializations = $this->Teacher->getAllSpecializations();
        $genders = $this->Teacher->getAllGenders();
        return view('pages.Teachers.edit',compact('Teachers','specializations','genders'));
    }

    public function update(StoreTeacher $request)
    {
        return $this->Teacher->UpdateTeacher($request);
    }


    public function destroy(Request $request)
    {
        return $this->Teacher->DeleteTeacher($request);
    }
}
