<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudent;
use App\Repository\StudentRepository;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    protected $student;
        public function __construct(StudentRepository $s){
            $this->student=$s;

        }

    public function index()
    {
       return $this->student->Get_Student();
    }


    public function create()
    {
        return $this->student->Create_Student();
    }


    public function store(StoreStudent $request)
    {
        return $this->student->Store_Student($request);
    }


    public function show($id)
    {
        return $this->student->Show_Student($id);
    }


    public function edit($id)
    {
        return $this->student->Edit_Student($id);
    }

    public function update(StoreStudent $request)
    {
        return $this->student->Update_Student($request);

    }

    public function destroy(Request $request)
    {
    return $this->student->Delete_Student($request);
    }

 /**   public function Get_classrooms($id)
    {

        return $this->student->Get_classroom($id);
    }

   public function Get_Sections($id)
    {

        return $this->student->Get_Sections($id);
    }
  */
    public function Upload_attachment ( Request $request)
    {
        return $this->student->Upload_attachment($request);

    }


    public function Download_attachment ($student_id,$file_name)
    {

        return $this->student->Download_attachment($student_id,$file_name);
    }

    public function Delete_attachment (Request  $request)
    {

         return $this->student->Delete_attachment($request);
    }


}
