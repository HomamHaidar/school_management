<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Repository\PaymentRepository;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
  protected $payment;
  public function __construct(PaymentRepository $payment)
  {
      $this->payment=$payment;
  }

    public function index()
    {
        return $this->payment->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->payment->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->payment->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->payment->show($id);
    }

    public function edit($id)
    {
        return $this->payment->edit($id);
    }

    public function update(Request $request)
    {
        return $this->payment->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->payment->destroy($request);
    }
}
