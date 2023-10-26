<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Repository\QuestionRepository;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $question;

    public function __construct(QuestionRepository $question)
    {
        $this->question=$question;
    }

    public function index()
    {
        return $this->question->index();
    }

    public function create()
    {
        return $this->question->create();
    }

    public function store(Request $request)
    {
        return $this->question->store($request);
    }


    public function show($id)
    {

    }

    public function edit($id)
    {
        return $this->question->edit($id);
    }


    public function update(Request $request)
    {
        return $this->question->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->question->destroy($request);
    }
}
