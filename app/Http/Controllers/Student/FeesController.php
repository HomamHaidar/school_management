<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFees;
use App\Repository\FeeRepository;
use Illuminate\Http\Request;

class FeesController extends Controller
{
  protected $fees;
  public function __construct(FeeRepository $fees)
  {
      $this->fees=$fees;
  }

    public function index()
    {
        return $this->fees->index();
    }


    public function create()
    {
        return $this->fees->create();
    }


    public function store(StoreFees $request)
    {
        return $this->fees->store($request);

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return  $this->fees->edit($id);
    }


    public function update(StoreFees $request)
    {
        return $this->fees->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->fees->destroy($request);

    }
}
