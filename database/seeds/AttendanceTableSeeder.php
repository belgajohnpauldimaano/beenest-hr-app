<?php

use Illuminate\Database\Seeder;

class AttendanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attendances')->insert([
            'date' => '2017-04-01',
            'user_id' => '1',
            'time_in' => '08:00:00',
            'time_out' => '06:00:00',
            'approved' => '0',
        ]);

        DB::table('attendances')->insert([
            'date' => '2017-04-02',
            'user_id' => '1',
            'time_in' => '09:00:00',
            'time_out' => '06:00:00',
            'approved' => '0',
        ]);

        DB::table('attendances')->insert([
            'date' => '2017-04-03',
            'user_id' => '1',
            'time_in' => '07:00:00',
            'time_out' => '06:30:00',
            'approved' => '0',
        ]);

        DB::table('attendances')->insert([
            'date' => '2017-04-04',
            'user_id' => '1',
            'time_in' => '07:00:00',
            'time_out' => '06:30:00',
            'approved' => '0',
        ]);

        DB::table('attendances')->insert([
            'date' => '2017-04-05',
            'user_id' => '1',
            'time_in' => '07:00:00',
            'time_out' => '06:30:00',
            'approved' => '0',
        ]);

        DB::table('attendances')->insert([
            'date' => '2017-04-06',
            'user_id' => '1',
            'time_in' => '07:00:00',
            'time_out' => '06:30:00',
            'approved' => '0',
        ]);

        DB::table('attendances')->insert([
            'date' => '2017-04-07',
            'user_id' => '1',
            'time_in' => '07:00:00',
            'time_out' => '06:30:00',
            'approved' => '0',
        ]);

        DB::table('attendances')->insert([
            'date' => '2017-04-08',
            'user_id' => '1',
            'time_in' => '07:00:00',
            'time_out' => '06:30:00',
            'approved' => '0',
        ]);

        DB::table('attendances')->insert([
            'date' => '2017-04-09',
            'user_id' => '1',
            'time_in' => '07:00:00',
            'time_out' => '06:30:00',
            'approved' => '0',
        ]);

        DB::table('attendances')->insert([
            'date' => '2017-04-10',
            'user_id' => '1',
            'time_in' => '07:00:00',
            'time_out' => '06:30:00',
            'approved' => '0',
        ]);

        DB::table('attendances')->insert([
            'date' => '2017-04-11',
            'user_id' => '1',
            'time_in' => '07:00:00',
            'time_out' => '06:30:00',
            'approved' => '0',
        ]);

        DB::table('attendances')->insert([
            'date' => '2017-04-12',
            'user_id' => '1',
            'time_in' => '07:00:00',
            'time_out' => '06:30:00',
            'approved' => '0',
        ]);

        DB::table('attendances')->insert([
            'date' => '2017-04-13',
            'user_id' => '1',
            'time_in' => '07:00:00',
            'time_out' => '06:30:00',
            'approved' => '0',
        ]);

        DB::table('attendances')->insert([
            'date' => '2017-04-14',
            'user_id' => '1',
            'time_in' => '07:00:00',
            'time_out' => '06:30:00',
            'approved' => '0',
        ]);

        DB::table('attendances')->insert([
            'date' => '2017-04-15',
            'user_id' => '1',
            'time_in' => '07:00:00',
            'time_out' => '06:30:00',
            'approved' => '0',
        ]);
    }
}
