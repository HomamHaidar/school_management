<?php

namespace App\Http\Controllers\Student\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        $information=Student::findOrFail(auth()->user()->id);
        return view('pages.Student.dashboard.profile',compact('information'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
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

        $Student=Student::findOrFail(auth()->user()->id);
        if (empty($request->password)){
            $Student->name=['en'=>$request->Name_en,'ar'=>$request->Name_ar];
            $Student->save();


        }
        else{
            $Student->name=['en'=>$request->Name_en,'ar'=>$request->Name_ar];
            $Student->password=Hash::make($request->password);
            $Student->save();


        }
        noty()->addSuccess(trans('messages.success'));
        return redirect()->back();
    }


    public function destroy($id)
    {
        //
    }
}
