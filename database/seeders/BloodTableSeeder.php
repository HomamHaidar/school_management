<?php

namespace Database\Seeders;

use App\Models\Type_Blood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type__bloods')->delete();
        $x=['O+','O-','A+','A-','B+','B-','AB+','AB-'];

        foreach ($x as $y){
            Type_Blood::create(['Name' => $y]);
        }
    }
}
