<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Repository\GraduatedRepository;
use App\Repository\GraduatedRepositoryInterface;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{

    protected $Graduated;
    public function __construct(GraduatedRepository $Graduated)
    {
        $this->Graduated=$Graduated;
    }
    public function index()
    {
        return $this->Graduated->index();
    }


    public function create()
    {
        return $this->Graduated->create();
    }

    public function store(Request $request)
    {
        return $this->Graduated->SoftDelete($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
       return $this->Graduated->SoftDelete_one_student($id);
    }

    public function update(Request $request)
    {
        return $this->Graduated->RestoreStudent($request);
    }


    public function destroy(Request $request)
    {

        return $this->Graduated->DeleteStudent($request);
    }
}
