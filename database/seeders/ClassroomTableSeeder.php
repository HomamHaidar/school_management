<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classrooms')->delete();
        $classrooms = [
            ['en'=> 'First grade', 'ar'=> 'الصف الاول'],
            ['en'=> 'Second grade', 'ar'=> 'الصف الثاني'],
            ['en'=> 'Third grade', 'ar'=> 'الصف الثالث'],
            ['en'=> 'fourth grade', 'ar'=> 'الصف الرابع'],
            ['en'=> 'fifth grade', 'ar'=> 'الصف الخامس'],
            ['en'=> 'sexth grade', 'ar'=> 'الصف السادس'],
            ['en'=> 'seventh grade', 'ar'=> 'الصف السابع'],
        ];

        foreach ($classrooms as $classroom) {
            Classroom::create([
                'Name_Class' => $classroom,
                'Grade_id' => Grade::all()->unique()->random()->id
            ]);
        }
    }

}

