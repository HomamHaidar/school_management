<?php
namespace App\Repository;

use App\Http\Requests\StoreTeacher;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface{

    public function getAllTeacher(){
         return Teacher::all();
    }

    public function StoreTeacher($request)
    {
//        $Teachers = new Teacher();
//        $Teachers->Email = $request->Email;
//        $Teachers->Password =  Hash::make($request->Password);
//        $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
//        $Teachers->Specialization_id = $request->Specialization_id;
//        $Teachers->Gender_id = $request->Gender_id;
//        $Teachers->Joining_Date = $request->Joining_Date;
//        $Teachers->Address = $request->Address;
//        $Teachers->save();


           try {
            $teacher=new Teacher();
            $teacher::create([
                'email'=>$request->Email,
                'password'=>Hash::make($request->Password),
                'Name'=>['en'=>$request->Name_en,'ar'=>$request->Name_ar],
                "Specialization_id" =>$request->Specialization_id,
                'Gender_id'=>$request->Gender_id,
                "Joining_Date"=>$request->Joining_Date,
                "Address"=>$request->Address

            ]);
        noty()->addSuccess(trans('messages.success'));
        return redirect()->route('Teachers.index');


        }
        catch (Exception $e){
            return redirect()->back()->with(['error',$e->getMessage()]);
        }



    }

    public function getAllGenders(){
        return Gender::all();
    }

    public function getAllSpecializations(){
       return Specialization::all();
    }

    public function EditTeacher($id)
    {
        $Teachers=Teacher::findOrFail($id);
        return $Teachers;
    }

    public function UpdateTeacher($request){

//        try {
//
//            $Teachers = Teacher::findOrFail($request->id);
//            $Teachers->Email = $request->Email;
//            $Teachers->Password =  Hash::make($request->Password);
//            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
//            $Teachers->Specialization_id = $request->Specialization_id;
//            $Teachers->Gender_id = $request->Gender_id;
//            $Teachers->Joining_Date = $request->Joining_Date;
//            $Teachers->Address = $request->Address;
//            $Teachers->save();
//            noty()->addSuccess(trans('messages.success'));
//            return redirect()->route('Teachers.index');
//        }
//        catch (Exception $e) {
//            return redirect()->back()->with(['error' => $e->getMessage()]);
//        }
        try {
            $teacher=Teacher::findOrFail($request->id);
            $teacher->update([
                'email'=>$request->Email,
                'password'=>Hash::make($request->Password),
                'Name'=>['en'=>$request->Name_en,'ar'=>$request->Name_ar],
                "Specialization_id" =>$request->Specialization_id,
                'Gender_id'=>$request->Gender_id,
                "Joining_Date"=>$request->Joining_Date,
                "Address"=>$request->Address
            ]);

            noty()->addInfo(trans('messages.Update'));
            return redirect()->route('Teachers.index');

        }
        catch(Exception $e){
            return redirect()->back()->with(['error',$e->getMessage()]);
        }

    }

    public function DeleteTeacher($request)
    {

         Teacher::findOrFail($request->id)->delete();
        noty()->addError(trans('messages.Delete'));
        return redirect()->route('Teachers.index');
    }
}

