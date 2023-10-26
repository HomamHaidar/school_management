<?php

namespace App\Repository;

use App\Models\Fee;
use App\Models\Grade;

class FeeRepository implements FeeRepositoryInterface
{

    public function index()
    {
        $fees=Fee::all();
        return view('pages.Fees.index',compact('fees'));
    }

    public function create()
    {
        $Grades =Grade::all();
        return view('pages.Fees.add',compact('Grades'));
    }

    public function edit($id)
    {
        $fee=Fee::findOrFail($id);
        $Grades=Grade::all();
        return view('pages.Fees.edit',compact('fee','Grades'));
    }

    public function store($request)
    {
        try {

            $fee=new Fee();
            $fee->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fee->amount=$request->amount;
            $fee->Grade_id=$request->Grade_id;
            $fee->Classroom_id=$request->Classroom_id;
            $fee->description=$request->description;
            $fee->year=$request->year;
            $fee->Fee_type=$request->Fee_type;
            $fee->save();


            noty()->addSuccess(trans('messages.success'));
            return redirect()->route('Fees.index');
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        try {
            $fee=Fee::findOrFail($request->id);
            $fee->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fee->amount=$request->amount;
            $fee->Grade_id=$request->Grade_id;
            $fee->Classroom_id=$request->Classroom_id;
            $fee->description=$request->description;
            $fee->year=$request->year;
            $fee->Fee_type=$request->Fee_type;
            $fee->save();

            noty()->addInfo(trans('messages.Update'));
            return redirect()->route('Fees.index');
        } catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function destroy($request)
    {
        Fee::findOrFail($request->id)->delete();
        noty()->addError(trans('messages.Delete'));
        return redirect()->back();
    }
}
