<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Repository\ProcessingFeeRepository;
use Illuminate\Http\Request;

class ProcessingFeeController extends Controller
{
    protected $processing;

    public function __construct(ProcessingFeeRepository $processing){
        $this->processing=$processing;
    }

    public function index()
    {
        return $this->processing->index();
    }


    public function create()
    {
        return $this->processing->create();
    }

    public function store(Request $request)
    {
        return $this->processing->store($request);
    }

    public function show($id)
    {
        return $this->processing->show($id);
    }


    public function edit($id)
    {
        return $this->processing->edit($id);
    }


    public function update(Request $request)
    {
        return $this->processing->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->processing->destroy($request);
    }
}
