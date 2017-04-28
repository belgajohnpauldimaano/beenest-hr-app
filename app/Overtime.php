<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    //
    public function attendance(){

        return $this->belongsTo(Attendance::class, 'user_id', 'id');

    }
}
