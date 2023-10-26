<?php

namespace App\Http\Controllers\Quizze;

use App\Http\Controllers\Controller;
use App\Repository\QuizzeRepository;
use Illuminate\Http\Request;

class QuizzeController extends Controller
{
    protected $quizze;

    public function __construct(QuizzeRepository $quizze)
    {
        $this->quizze=$quizze;
    }

    public function index()
    {
        return $this->quizze->index();
    }

    public function create()
    {
        return $this->quizze->create();
    }


    public function store(Request $request)
    {
        return $this->quizze->Store($request);
    }


    public function show($id)
    {

    }

    public function edit($id)
    {
        return $this->quizze->edit($id);
    }

    public function update(Request $request)
    {
        return $this->quizze->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->quizze->destroy($request);
    }
}
