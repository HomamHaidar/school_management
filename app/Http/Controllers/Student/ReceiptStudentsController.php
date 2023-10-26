<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Repository\ReceiptStudentsRepository;
use Illuminate\Http\Request;

class ReceiptStudentsController extends Controller
{
   protected $receipt;

   public function __construct(ReceiptStudentsRepository $receipt){
       $this->receipt=$receipt;
   }

    public function index()
    {
        return $this->receipt->index();
    }

    public function create()
    {
        return $this->receipt->create();
    }

    public function store(Request $request)
    {
        return $this->receipt->store($request);
    }


    public function show($id)
    {
        return $this->receipt->show($id);
    }

    public function edit($id)
    {
        return $this->receipt->edit($id);
    }


    public function update(Request $request)
    {
        return $this->receipt->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request)
    {
        return $this->receipt->destroy($request);
    }
}
