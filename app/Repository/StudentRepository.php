<?php
namespace App\Repository;

use App\Models\Classroom;
use App\Models\Comment;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Post;
use App\Models\Promotion;
use App\Models\Sections;
use App\Models\Student;
use App\Models\Type_Blood;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface{


    public function Create_Student()
    {
        $data['my_classes']=Grade::all();
        $data['parents']=My_Parent::all();
        $data['Genders']=Gender::all();
        $data['nationals']=Nationalitie::all();
        $data['bloods']=Type_Blood::all();
        return view('pages.Student.add',$data);
    }

    public function Get_classroom($id)
    {
        $list_class=Classroom::where('Grade_id',$id)->pluck('Name_Class','id');
        return $list_class;
    }

    public function Get_Sections($id)
    {
        $list_sections=Sections::where('class_id',$id)->pluck('Name_Section','id');
        return $list_sections;
    }

    public function Store_Student($request){
         DB::beginTransaction();
        try {

            $student=new Student();

            $student->name=['en'=>$request->name_en,'ar'=>$request->name_ar];
            $student->email=$request->email;
            $student->password=Hash::make($request->password);

            $student->gender_id=$request->gender_id;
            $student->nationalitie_id=$request->nationalitie_id;
            $student->blood_id=$request->blood_id;
            $student->Date_Birth=$request->Date_Birth;

            $student->Grade_id=$request->Grade_id;
            $student->Classroom_id=$request->Classroom_id;
            $student->section_id=$request->section_id;

            $student->parent_id=$request->parent_id;
            $student->academic_year=$request->academic_year;


            $student->save();

            if ($request->hasfile('photos')){

                foreach ($request->file('photos') as $file){
                    $name=$file->getClientOriginalName();
//                    $name1= urlencode($name);
                    $fileName=iconv('utf-8','windows-1256', $file->getClientOriginalName());

                    $file->storeas('attachments/students/'.$student->id,$fileName,'upload_attachments');


                    $image=new Image();
                    $image->file_name=$name;
                    $image->imageable_id=$student->id;
                    $image->imageable_type='App\Models\Student';
                    $image->save();
                }


            }
            DB::commit();
            noty()->addSuccess(trans('messages.success'));
            return redirect()->route('Students.index');


        }
        catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}

    public function Get_Student()
    {
          $students=  Student::all();
          return view('pages.Student.index',compact('students'));
    }

    public function Edit_Student($id)
    {

//        try {

            $Students=Student::findOrFail($id);

//            if ($Students->email !=auth()->user()->email){
//
//                abort(403);
//            }

                $data['Grades']=Grade::all();
                $data['parents']=My_Parent::all();
                $data['Genders']=Gender::all();
                $data['nationals']=Nationalitie::all();
                $data['bloods']=Type_Blood::all();

                return view('pages.Student.edit',$data,compact('Students'));

//        catch (\Exception $e){
//            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
//
//    }




        }

    public function Update_Student($request){
        try {
            $student=Student::findOrFail($request->id);
            if ($student->Grade_id !=$request->Grade_id and $student->Classroom_id != $request->Classroom_id and  $student->section_id != $request->section_id and $student->academic_year!=$request->academic_year){
                Promotion::updateOrCreate([

                    'student_id' => $request->id,
                    'from_grade' =>$student->Grade_id,
                    'from_Classroom' => $student->Classroom_id,
                    'from_section' => $student->section_id,
                    'academic_year' => $student->academic_year,
                    'to_grade' => $request->Grade_id,
                    'to_Classroom' => $request->Classroom_id,
                    'to_section' => $request->section_id,
                    'academic_year_new' => $request->academic_year
                ]);
            }


            $student->update([
                'name'=>['en'=>$request->name_en,'ar'=>$request->name_ar],
                'email'	=>$request->email,
                'password'=>Hash::make($request->password),
                'gender_id'=>$request->gender_id,
                'nationalitie_id'=>$request->nationalitie_id,
                'blood_id'=>$request->blood_id,
                "Date_Birth"=>$request->Date_Birth,
                'Grade_id'=>$request->Grade_id,
                'Classroom_id'=>$request->Classroom_id,
                'section_id'=>$request->section_id,
                'parent_id'=>$request->parent_id,
                'academic_year'=>$request->academic_year,
            ]);



            noty()->addInfo(trans('messages.Update'));
            return redirect()->route('Students.index');
        }  catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

}

    public function Delete_Student($request){
       Student::findOrFail($request->id)->forceDelete();
        noty()->addError(trans('messages.Delete'));
        return redirect()->route('Students.index');
    }

    public function Show_Student($id)
    {
        $Student=Student::findOrFail($id);
        return view('pages.Student.show',compact('Student'));


    }

    public function Upload_attachment($request)
    {

            foreach ($request->file('photos') as $file) {
                $name = $file->getClientOriginalName();
                $fileName=iconv('utf-8','windows-1256', $file->getClientOriginalName());

                $file->storeas('attachments/students/'.$request->student_id , $fileName ,'upload_attachments');

                $image = new Image();
                $image->file_name = $name;
                $image->imageable_id = $request->student_id;
                $image->imageable_type = 'App\Models\Student';
                $image->save();
            }
        noty()->addSuccess(trans('messages.success'));
        return redirect()->back();


    }

    public function Download_attachment($student_id, $file_name)
    {
        $file_name_1=iconv('utf-8','windows-1256', $file_name);
         return response()->download(public_path('attachments/students/').$student_id.'/'.$file_name_1);
//         return Storage::download(public_path('attachments/students/').$student_id.'/'.$file_name_1);
    }


    public function Delete_attachment($request)
    {
        $file_name_1=iconv('utf-8','windows-1256', $request->file_name);
        Storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_id.'/'.$file_name_1);
//        return response()->delete(public_path('attachments/students/').$request->student_id.'/'.$file_name_1);
//        return  Storage::delete(public_path('attachments/students/').$request->student_id.'/'.$file_name_1);
        Image::where('id',$request->id)->delete();
        noty()->addError(trans('messages.Delete'));
        return redirect()->back();
    }
}


