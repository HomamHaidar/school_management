<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSection;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Sections;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $Grades=Grade::with('Sections')->get();//with('sections) for using sections relation which i put in grade model so ican show s
        $list_Grades=Grade::all();
        $teachers=Teacher::all();
        return view('pages.Sections.Sections',compact('Grades','list_Grades','teachers'));
    }


    public function create()
    {
        //
    }



    public function store(StoreSection $request)
    {

    try {

            $validated = $request->validated();

            $section = new Sections();
            $section
                ->setTranslation('Name_Section', 'en', $request->Name_Section_En)
                ->setTranslation('Name_Section', 'ar', $request->Name_Section_Ar);
           $section->Grade_id = $request->Grade_id;
           $section->Class_id = $request->Class_id;
           $section ->Status = 1;
           $section ->save();
           $section ->teachers()->attach($request->teacher_id);

            noty()->addSuccess(trans('messages.success'));
            return redirect()->route('Sections.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);


        }
    }


    public function show(Sections $sections)
    {
        //
    }


    public function edit(Sections $sections)
    {
        //
    }


    public function update(StoreSection $request)
    {
        try {

            $validated = $request->validated();

            $section = Sections::findOrFail($request->id);
            $section->update([
                $section ->setTranslation('Name_Section', 'en', $request->Name_Section_En),
                $section ->setTranslation('Name_Section', 'ar', $request->Name_Section_Ar),
                $section->Grade_id = $request->Grade_id,
                $section->Class_id = $request->Class_id
            ]);


            if(isset($request->Status)) {
                $section->Status = 1;
            } else {
                $section->Status = 2;
            }

            if (isset($request->teacher_id)){
                $section->teachers()->sync($request->teacher_id);
            }
            else{
                $section->teachers()->sync(array());

            }
            $section->save();

            noty()->addInfo(trans('messages.Update'));
            return redirect()->route('Sections.index');

        }
      catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {

            Sections::findorFail($request->id)->delete();
            noty()->addError(trans('messages.Delete'));
            return redirect()->route('Sections.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function getclasses($id){
        $list_class = Classroom::where("Grade_id", $id)->pluck("Name_Class", "id");

        return $list_class;
    }
}
