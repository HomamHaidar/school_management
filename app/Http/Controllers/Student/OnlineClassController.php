<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Traits\MeetingZoomTrait;
use App\Models\Grade;
use App\Models\OnlineClasse;
use Illuminate\Http\Request;
use Jubaer\Zoom\Facades\Zoom;


class OnlineClassController extends Controller
{
        use MeetingZoomTrait;
    public function index()
    {
        $online_classes=OnlineClasse::all();
        return view('pages.online_classes.index',compact('online_classes'));
    }

    public function create()
    {
        $Grades=Grade::all();
        return view('pages.online_classes.add',compact('Grades'));
    }


    public function store(Request $request)
    {
        try {


            noty()->addSuccess(trans('messages.success'));
            return redirect()->route('Online_Class.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
