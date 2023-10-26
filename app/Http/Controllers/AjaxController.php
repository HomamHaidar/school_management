<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Sections;
use App\Models\Teacher;

class AjaxController extends Controller
{
    public function Get_classrooms($id)
    {
        $list_class = Classroom::where('Grade_id', $id)->pluck('Name_Class', 'id');
        return $list_class;
    }

    public function Get_Sections($id)
    {

     /**   $list_sections1 = Sections::where('class_id', $id)->pluck('Name_Section', 'id');
        if (auth('web')->check()) {
            $list_sections=$list_sections1;
            return $list_sections;
        }
        elseif (auth('teacher')->check()) {
            $teacher_id=Teacher::findOrFail(auth()->user()->id)->sections()->pluck('section_id');
            $list_sections= $list_sections1::whereIn('id', $teacher_id)->get();
          //  $list_sections = Sections::whereIn('id', $teacher_id)->where('class_id', $id)->pluck('Name_Section', 'id');
            return $list_sections;
        }
    */

        $list_sections = Sections::where('class_id', $id)->pluck('Name_Section', 'id');
        return $list_sections;

    }
}
