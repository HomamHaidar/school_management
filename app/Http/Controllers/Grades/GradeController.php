<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGardes;
use App\Models\Classroom;
use App\Models\Grade;

use Illuminate\Http\Request;


class GradeController extends Controller
{

    public function index()
    {
        $Grades=Grade::all();
        return view('pages.Grades.grades',compact('Grades'));
    }


    public function create()
    {
        //
    }


    public function store(StoreGardes $request)
    {
//        if (Grade::where('Name->ar',$request->Name)->orWhere('Name->en',$request->Name_en)->exists()){
//            noty()->addError(trans('Grades_trans.exists'));
//            return redirect()->back();
//
//        }
        try {
            $validated = $request->validated();

            $Grade=new Grade();

            $Grade
                ->setTranslation('Name', 'en', $request->Name_en)
                ->setTranslation('Name', 'ar', $request->Name)
                ->Notes=$request->Notes;

            $Grade->save();
            noty()->addSuccess(trans('messages.success'));
            return redirect()->route('grade.index');

        }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
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


    public function update(StoreGardes $request)
    {


//        if (Grade::where('Name', $request->Name)->orWhere('Name->en', $request->Name_en)->whereNotIn('id', [$request->id])->exists()) {
//            noty()->addError(trans('Grades_trans.exists'));
//            return redirect()->back();
//        }
        try {
            $validated = $request->validated();
            $grade=Grade::findOrFail($request->id);
            $grade->update([
                $grade
                    ->setTranslation('Name', 'en', $request->Name_en)
                    ->setTranslation('Name', 'ar', $request->Name)
                    ->Notes=$request->Notes
            ]);
            noty()->addInfo(trans('messages.Update'));

            return redirect()->route('grade.index');

            }
        catch (\Exception $e)
        {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function destroy(Request $request)
    {
        try {
            $Grade=Grade::findorFail($request->id);
//            $class=Classroom::where('Grade_id','=',$request->id)->get();
               $class=Classroom::where('Grade_id','=',$request->id)->pluck('Grade_id');

              if(!$class->isEmpty()) {

                  noty()->addError(trans('messages.warning'));
                  return redirect()->route('grade.index');
              }

              $Grade->delete();
            noty()->addError(trans('messages.Delete'));
            return redirect()->route('grade.index');

        }
        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
