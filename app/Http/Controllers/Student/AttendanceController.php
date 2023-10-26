<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Repository\AttendanceRepository;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $attendance;

    public function __construct(AttendanceRepository $attendance)
    {
        $this->attendance=$attendance;
    }

    public function index()
    {
        return $this->attendance->index();
    }


    public function store(Request $request)
    {
        return $this->attendance->Store($request);
    }


    public function show($id)
    {
        return $this->attendance->show($id) ;
    }


}
