<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'username' => 'satawat',
            'password' => bcrypt('stworchwk'),
            'full_name' => 'ศตวรรษ อรชุนเวคิน',
            'contact' => '',
            'active' => 1,
            'type' => 0
        ];

        \App\User::insert($data);
    }
}
