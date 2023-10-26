<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Sections;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->delete();

        $Sections = [
            ['en' => 'a', 'ar' => 'ا'],
            ['en' => 'b', 'ar' => 'ب'],
            ['en' => 'c', 'ar' => 'ت'],
            ['en' => 'd', 'ar' => 'ج'],
            ['en' => 'e', 'ar' => 'ح'],
            ['en' => 'f', 'ar' => 'خ'],
            ['en' => 'g', 'ar' => 'د'],
        ];

        foreach ($Sections as $section) {
            Sections::create([
                'Name_Section' => $section,
                'Status' => 1,
                'Grade_id' => Grade::all()->unique()->random()->id,
                'Class_id' => Classroom::all()->unique()->random()->id,
            ]);
        }
    }
}
