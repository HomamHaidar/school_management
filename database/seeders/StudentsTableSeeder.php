<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Sections;
use App\Models\Specialization;
use App\Models\Student;
use App\Models\Type_Blood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->delete();
        $students = new Student();
        $students->name = ['ar' => 'احمد ابراهيم', 'en' => 'Ahmed Ibrahim'];
        $students->email = 'Ahmed_Ibrahim@yahoo.com';
        $students->password = Hash::make('12345678');
        $students->gender_id = 1;
        $students->nationalitie_id = Nationalitie::all()->unique()->random()->id;
        $students->blood_id =Type_Blood::all()->unique()->random()->id;
        $students->Date_Birth = date('1995-01-01');
        $students->Grade_id = Grade::all()->unique()->random()->id;
        $students->Classroom_id =Classroom::all()->unique()->random()->id;
        $students->section_id = Sections::all()->unique()->random()->id;
        $students->parent_id = My_Parent::all()->unique()->random()->id;
        $students->academic_year ='2023';
        $students->save();

        $students2 = new Student();
        $students2->name = ['ar' => 'همام حيدر', 'en' => 'homam hadiar'];
        $students2->email = 'homamhaidar18@gmail.com';
        $students2->password = Hash::make('12345678');
        $students2->gender_id = 1;
        $students2->nationalitie_id = Nationalitie::all()->unique()->random()->id;
        $students2->blood_id =Type_Blood::all()->unique()->random()->id;
        $students2->Date_Birth = date('2002-09-09');
        $students2->Grade_id = Grade::all()->unique()->random()->id;
        $students2->Classroom_id =Classroom::all()->unique()->random()->id;
        $students2->section_id = Sections::all()->unique()->random()->id;
        $students2->parent_id = My_Parent::all()->unique()->random()->id;
        $students2->academic_year ='2023';
        $students2->save();
    }
}
