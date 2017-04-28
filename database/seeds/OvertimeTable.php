<?php

use Illuminate\Database\Seeder;

class OvertimeTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('overtimes')->insert([
            'attendance_id' => '1',
            'overtime'      => '0.50',
            'approved'      => '0'
        ]);
    }
}
