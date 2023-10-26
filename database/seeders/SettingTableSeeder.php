<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('settings')->delete();

        $data = [
            ['key' => 'current_session', 'value' => '2023-2024'],
            ['key' => 'school_title', 'value' => 'HM'],
            ['key' => 'school_name', 'value' => 'Homam Haidar International Schools'],
            ['key' => 'end_first_term', 'value' => '01-12-2021'],
            ['key' => 'end_second_term', 'value' => '01-05-2022'],
            ['key' => 'phone', 'value' => '0933983775'],
            ['key' => 'address', 'value' => 'اللاذقية'],
            ['key' => 'school_email', 'value' => 'homamhaidar18@gmail.com'],
            ['key' => 'logo', 'value' => '1.jpg'],
        ];

        DB::table('settings')->insert($data);
    }
}
