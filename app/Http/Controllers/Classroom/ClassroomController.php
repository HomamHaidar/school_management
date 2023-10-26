<?php

namespace App\Http\Controllers\Classroom;
use App\Http\Requests\StoreClass;
use App\Http\Requests\StoreGardes;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassroomController extends Controller
{


  public function index()
  {

      $Classes=Classroom::all();
      $Grades=Grade::all();
    return view('pages.Classrooms.classroom',compact('Classes','Grades'));
  }


  public function create()
  {

  }


  public function store(StoreClass $request)
  {
      $List_Classes = $request->List_Classes;
      try {
          $validated = $request->validated();
            foreach ($List_Classes as $list){
                $My_Classes= new Classroom();
                $My_Classes
                    ->setTranslation('Name_Class', 'en', $list['Name_class_en'])
                    ->setTranslation('Name_Class', 'ar', $list['Name'])
                    ->Grade_id=$list['Grade_id'];

                 $My_Classes->save();
            }
          noty()->addSuccess(trans('messages.success'));
          return redirect()->route('classrooms.index');

      }
      catch (\Exception $e){
          return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
      }

  }


  public function show($id)
  {

  }


  public function edit($id)
  {

  }


  public function update(Request $request)
  {
      try {

          $class=Classroom::findorFail($request->id);
          $class->update([
             $class
              ->setTranslation('Name_Class', 'en', $request->Name_en)
              ->setTranslation('Name_Class', 'ar', $request->Name)
               ->Grade_id=$request->Grade_id
          ]);

              noty()->addInfo(trans('messages.Update'));
              return redirect()->route('classrooms.index');

      }
      catch (\Exception $e){
          return redirect()->back()->withErrors(['errors'=>$e->getMessage()]);
      }
  }


  public function destroy(Request $request)
  {
      try {
          Classroom::findorFail($request->id)->delete();
          noty()->addError(trans('messages.Delete'));
          return redirect()->route('classrooms.index');
      }
      catch (\Exception $e){
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);

      }

  }

  public function delete_all(Request $request)
  {
         $class=explode(',',$request->delete_all_id);//array_of_id
          Classroom::whereIn('id', $class)->delete();//more than one id so wherein
          noty()->addError(trans('messages.Delete'));
          return redirect()->route('classrooms.index');


  }

  public function fillter_class (Request $request)
    {
        $Grades=Grade::all();
        $Search=Classroom::select('*')->where('Grade_id','=',$request->Grade_id)->get();//get every thing have this grade_id
        return view('pages.Classrooms.classroom',compact('Grades'))->withDetails($Search);//details
    }
}

