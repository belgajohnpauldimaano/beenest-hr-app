<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call('UsersTableSeeder');
      $this->command->info('UsersTableSeeder table seeded!');
      $this->call('AttendanceTableSeeder');
      $this->command->info('AttendanceTableSeeder table seeded!');
      $this->call('OvertimeTable');
      $this->command->info('AttendanceTableSeeder table seeded!');
    }
}
