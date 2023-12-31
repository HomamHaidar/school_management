<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();
        $genders=[
        ['en'=>'Male','ar'=>'ذكر'],
        ['en'=>'Female','ar'=>'انثى']
        ];

        foreach ($genders as $g){
            Gender::create(['Name'=>$g]);
        }
    }
}
