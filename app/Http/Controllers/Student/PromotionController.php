<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Repository\PromotionRepository;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    protected $promotions;

    public function __construct(PromotionRepository  $promotions)
  {
      $this->promotions=$promotions;
  }

    public function index()
    {
        return $this->promotions->index();
    }

    public function create()
    {
        return $this->promotions->create();
    }


    public function store(Request $request)
    {
        return $this->promotions->store($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Request $request)
    {
        return $this->promotions->destroy($request);
    }
}
