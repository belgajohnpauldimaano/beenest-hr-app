<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createforeignkeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        Schema::table('attendances', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
        // Schema::table('attendances', function(Blueprint $table) {
        //     $table->foreign('overtime_id')->references('id')->on('overtimes')
        //                 ->onDelete('restrict')
        //                 ->onUpdate('restrict');
        // });

        Schema::table('leaves', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });

        Schema::table('overtimes', function(Blueprint $table) {
            $table->foreign('attendance_id')->references('id')->on('attendances')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });

        // Schema::table('user_meta', function(Blueprint $table) {
        //     $table->foreign('user_id')->references('id')->on('users')
        //                 ->onDelete('restrict')
        //                 ->onUpdate('restrict');
        // });
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        Schema::drop('overtimes');
        Schema::drop('leaves');
        Schema::drop('attendances');
        Schema::drop('users');
    }
}
