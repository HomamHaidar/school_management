<?php

namespace App\Repository;

use App\Http\Requests\StoreTeacher;
use App\Models\Gender;
use App\Models\Specialization;

interface TeacherRepositoryInterface{

    public function getAllTeacher();

    public function StoreTeacher($request);

    public function getAllGenders();

    public function getAllSpecializations();

    public function EditTeacher($id);

    public function UpdateTeacher($request);

    public function DeleteTeacher($request);



}

