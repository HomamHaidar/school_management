<?php

namespace App\Http\Livewire;

use App\Models\Image;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\ParentAttachment;
use App\Models\Religion;
use App\Models\Type_Blood;
use Exception;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;


    public $successMessage = '';
    public $catchError;
    public $photos;
    public $show_table = true;
    public $update_mode = false;
    public $show_one_father = false;
    public $Parent_id;
    public $Parent;
    public $currentStep = 1,


        // Father_INPUTS
        $email, $password,
        $Name_Father, $Name_Father_en,
        $National_ID_Father, $Passport_ID_Father,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Nationality_Father_id, $Blood_Type_Father_id,
        $Address_Father, $Religion_Father_id,

        // Mother_INPUTS
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mothers_id, $Blood_Type_Mothers_id,
        $Address_Mother, $Religion_Mothers_id;


    public function render()
    {

        return view('livewire.add-parent', [
            'Nationalities' => Nationalitie::all(),
            'Type_Bloods' => Type_Blood::all(),
            'Religions' => Religion::all(),
            'my_parents' => My_Parent::all(),
            'Parent' => $this->Parent,


        ]);

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [

            'email' => 'required|email',
            'password' => 'required',
            'National_ID_Father' => 'string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Father' => 'min:10|max:10',
            'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'National_ID_Mother' => 'string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'min:10|max:10',
            'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);
    }

    public function edit($id)
    {

        $this->show_table = false;
        $this->update_mode = true;

        $My_parent = My_Parent::where('id', $id)->first();

        $this->Parent_id = $id;
        $this->email = $My_parent->email;
        $this->password = $My_parent->password;
        $this->Name_Father = $My_parent->getTranslation('Name_Father', 'ar');
        $this->Name_Father_en = $My_parent->getTranslation('Name_Father', 'en');
        $this->Job_Father = $My_parent->getTranslation('Job_Father', 'ar');
        $this->Job_Father_en = $My_parent->getTranslation('Job_Father', 'en');
        $this->National_ID_Father = $My_parent->National_ID_Father;
        $this->Passport_ID_Father = $My_parent->Passport_ID_Father;
        $this->Phone_Father = $My_parent->Phone_Father;
        $this->Nationality_Father_id = $My_parent->Nationality_Father_id;
        $this->Blood_Type_Father_id = $My_parent->Blood_Type_Father_id;
        $this->Address_Father = $My_parent->Address_Father;
        $this->Religion_Father_id = $My_parent->Religion_Father_id;

        $this->Name_Mother = $My_parent->getTranslation('Name_Mother', 'ar');
        $this->Name_Mother_en = $My_parent->getTranslation('Name_Mother', 'en');
        $this->Job_Mother = $My_parent->getTranslation('Job_Mother', 'ar');
        $this->Job_Mother_en = $My_parent->getTranslation('Job_Mother', 'en');
        $this->National_ID_Mother = $My_parent->National_ID_Mother;
        $this->Passport_ID_Mother = $My_parent->Passport_ID_Mother;
        $this->Phone_Mother = $My_parent->Phone_Mother;
        $this->Nationality_Mothers_id = $My_parent->Nationality_Mothers_id;
        $this->Blood_Type_Mothers_id = $My_parent->Blood_Type_Mothers_id;
        $this->Address_Mother = $My_parent->Address_Mother;
        $this->Religion_Mothers_id = $My_parent->Religion_Mothers_id;
    }

    public function showformadd()
    {
        $this->show_table = false;
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'email' => 'required|unique:my__parents,email,' . $this->id,
            'password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my__parents,National_ID_Father,' . $this->id,
            'Passport_ID_Father' => 'required|unique:my__parents,Passport_ID_Father,' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);
        $this->currentStep = 2;

    }

    public function secondStepSubmit()
    {

        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:my__parents,National_ID_Mother,' . $this->id,
            'Passport_ID_Mother' => 'required|unique:my__parents,Passport_ID_Mother,' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mothers_id' => 'required',
            'Blood_Type_Mothers_id' => 'required',
            'Religion_Mothers_id' => 'required',
            'Address_Mother' => 'required',
        ]);

        $this->currentStep = 3;

    }

    public function submitForm()
    {
        try {
            $My_Parent = new My_Parent();

            // Father_INPUTS
            $My_Parent->email = $this->email;
            $My_Parent->password = Hash::make($this->password);
            $My_Parent->Name_Father = ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father];
            $My_Parent->National_ID_Father = $this->National_ID_Father;
            $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
            $My_Parent->Phone_Father = $this->Phone_Father;
            $My_Parent->Job_Father = ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father];
            $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
            $My_Parent->Nationality_Father_id = $this->Nationality_Father_id;
            $My_Parent->Blood_Type_Father_id = $this->Blood_Type_Father_id;
            $My_Parent->Religion_Father_id = $this->Religion_Father_id;
            $My_Parent->Address_Father = $this->Address_Father;

            // Mother_INPUTS
            $My_Parent->Name_Mother = ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother];
            $My_Parent->National_ID_Mother = $this->National_ID_Mother;
            $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $My_Parent->Phone_Mother = $this->Phone_Mother;
            $My_Parent->Job_Mother = ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother];
            $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $My_Parent->Nationality_Mothers_id = $this->Nationality_Mothers_id;
            $My_Parent->Blood_Type_Mothers_id = $this->Blood_Type_Mothers_id;
            $My_Parent->Religion_Mothers_id = $this->Religion_Mothers_id;
            $My_Parent->Address_Mother = $this->Address_Mother;

            $My_Parent->save();

            //Attachment

            if (!empty($this->photos)) {


                foreach ($this->photos as $photo) {
                    $name = $photo->getClientOriginalName();
                    $fileName = iconv('utf-8', 'windows-1256', $photo->getClientOriginalName());
                    $photo->storeAs('attachments/parents/' . $this->National_ID_Father, $fileName, 'upload_attachments'); //to save in local serve

                    $image = new Image();
                    $image->file_name = $name;
                    $image->imageable_id = $My_Parent->id;
                    $image->imageable_type = 'App\Models\My_Parent';
                    $image->save();
                }

            }


//          $this->successMessage = trans('messages.success');
            $this->clearForm();
            noty()->addSuccess(trans('messages.success'));
            $this->redirect('add_parent');
        } catch (Exception $e) {
            $this->catchError = $e->getMessage();
        }
    }

    public function firstStepSubmit_edit()
    {
        $this->currentStep = 2;
    }

    public function secondStepSubmit_edit()
    {
        $this->currentStep = 3;

    }

    public function submitForm_edit()
    {

        if ($this->Parent_id) {
            $parent = My_Parent::findorFail($this->Parent_id);
            $parent
                ->setTranslation('Name_Father', 'en', $this->Name_Father_en)
                ->setTranslation('Name_Father', 'ar', $this->Name_Father)
                ->setTranslation('Job_Father', 'en', $this->Job_Father_en)
                ->setTranslation('Job_Father', 'ar', $this->Job_Father)
                ->setTranslation('Name_Mother', 'en', $this->Name_Mother_en)
                ->setTranslation('Name_Mother', 'ar', $this->Name_Mother)
                ->setTranslation('Job_Mother', 'en', $this->Job_Mother_en)
                ->setTranslation('Job_Mother', 'ar', $this->Job_Mother);
            $parent->update([

                'email' => $this->email,
                'password' => $this->password,
                'National_ID_Father' => $this->National_ID_Father,
                'Passport_ID_Father' => $this->Passport_ID_Father,
                'Phone_Father' => $this->Phone_Father,
                'Nationality_Father_id' => $this->Nationality_Father_id,
                'Blood_Type_Father_id' => $this->Blood_Type_Father_id,
                'Address_Father' => $this->Address_Father,
                'Religion_Father_id' => $this->Religion_Father_id,


                'National_ID_Mother' => $this->National_ID_Mother,
                'Passport_ID_Mother' => $this->Passport_ID_Mother,
                'Phone_Mother' => $this->Phone_Mother,
                'Nationality_Mothers_id' => $this->Nationality_Mothers_id,
                'Blood_Type_Mothers_id' => $this->Blood_Type_Mothers_id,
                'Address_Mother' => $this->Address_Mother,
                'Religion_Mothers_id' => $this->Religion_Mothers_id,

            ]);

            if (!empty($this->photos)) {
                return redirect()->route('dashboard');

                foreach ($this->photos as $photo) {
                    $name = $photo->getClientOriginalName();
                    $fileName = iconv('utf-8', 'windows-1256', $photo->getClientOriginalName());
                    $photo->storeAs('attachments/parents/' . $this->National_ID_Father, $fileName, 'upload_attachments'); //to save in local serve

                    $image = new Image();
                    $image->file_name = $name;
                    $image->imageable_id = $this->Parent_id;
                    $image->imageable_type = 'App\Models\My_Parent';
                    $image->save();
                }

            }
            noty()->addInfo(trans('messages.Update'));
            return redirect()->route('add_parent');
        }
    }


    public function Download_attachment($parent_id, $file_name)
    {

        $file_name_1 = iconv('utf-8', 'windows-1256', $file_name);

        return response()->download(public_path('attachments/parents/') . $parent_id . '/' . $file_name_1);
    }

    public function Submit_attachment_update($parent_id ,$National_ID_Father){

        foreach ($this->photos as $photo) {
            $name = $photo->getClientOriginalName();
            $fileName = iconv('utf-8', 'windows-1256', $photo->getClientOriginalName());
            $photo->storeAs('attachments/parents/' . $National_ID_Father, $fileName, 'upload_attachments'); //to save in local serve

            $image = new Image();
            $image->file_name = $name;
            $image->imageable_id = $parent_id;
            $image->imageable_type = 'App\Models\My_Parent';
            $image->save();

        }
        noty()->addSuccess(trans('messages.success'));
        $this->redirect('add_parent');
        }



//    public function Delete_attachment($parent_id, $file_name,$id)
//    {
//            $file_name_1=iconv('utf-8','windows-1256', $file_name);
//            Storage::disk('upload_attachments')->delete('attachments/students/'.$parent_id.'/'.$file_name_1);            Image::where('id',$id)->delete();
//            noty()->addError(trans('messages.Delete'));
//            return redirect()->back();
//
////        return  Storage::delete(public_path('attachments/students/').$request->student_id.'/'.$file_name_1);
////        Storage::disk('upload_attachments')->delete('attachments/students/'.$parent_id.'/'.$file_name_1);
//    }

    public function delete($id)
    {

        $files = Image::where('imageable_id', $id)->get();


        if (!$files->isEmpty()) {
            noty()->addError(trans('messages.warning_attachments'));
            return redirect()->route('add_parent');
        }
        $My_parent = My_Parent::findOrFail($id)->delete();
        noty()->addError(trans('messages.Delete'));
        return redirect()->route('add_parent');
    }

    public function show($id)
    {

        $this->Parent = My_Parent::findOrFail($id);
        $this->show_table = false;
        $this->show_one_father = true;

    }

    public function back($x)
    {
        $this->currentStep = $x;

    }

    public function clearForm()
    {
        $this->email = '';
        $this->password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father = '';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father = '';
        $this->Religion_Father_id = '';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother = '';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mothers_id = '';
        $this->Blood_Type_Mothers_id = '';
        $this->Address_Mother = '';
        $this->Religion_Mothers_id = '';

    }


}

