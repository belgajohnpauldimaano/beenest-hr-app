<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            'name'          => 'Admin Beenest',
            'employee_no'   => '001',
            'password'      => bcrypt('pass123'),
            'type'          => 'Admin',
            'email'         => 'admin@beenest.com',
            'image'         => NULL,
            'start_date'    => NULL,
            'end_date'      => NULL,
        ]);
        DB::table('users')->insert([
            'name'          => 'Staff Beenest',
            'employee_no'   => '002',
            'password'      => bcrypt('pass123'),
            'type'          => 'Staff',
            'email'         => 'staff@beenest.com',
            'image'         => NULL,
            'start_date'    => NULL,
            'end_date'      => NULL,
        ]);
        DB::table('users')->insert([
            'name'          => 'Others Beenest',
            'employee_no'   => '003',
            'password'      => bcrypt('pass123'),
            'type'          => 'Others',
            'email'         => 'others@beenest.com',
            'image'         => NULL,
            'start_date'    => NULL,
            'end_date'      => NULL,

        ]);
    }
}
