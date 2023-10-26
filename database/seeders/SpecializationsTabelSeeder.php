<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationsTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();
        $spec=[
          ['en'=>'Arabic','ar'=>'عربي'],
          ['en'=>'Sciences','ar'=>'علوم'],
          ['en'=>'Math','ar'=>'رياضيات'],
          ['en'=>'English','ar'=>'انكليزي'],
        ];
        foreach ($spec as $s){
            Specialization::create(["Name"=>$s]);
        }
    }
}
