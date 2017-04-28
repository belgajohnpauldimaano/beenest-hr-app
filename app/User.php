<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /*
    * To use -> User::$types['Admin']
    */
    public static $types = [
        'Admin' => 'Admin',
        'Staff' => 'Staff',
        'Others' => 'Others'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_no', 'name', 'password', 'type', 'email', 'mobile', 'isVerified', 'start_date', 'end_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates  = [
        'start_date', 'end_date', 'deleted_at',
    ];

    public function attendances(){

        return $this->hasMany(Attendance::class);

    }

    public function announcements(){

        return $this->hasMany(Announcement::class);

    }

    public function leaves(){

        return $this->hasMany(Leave::class);

    }

    public function usermeta(){

        return $this->hasMany(UserMeta::class);

    }

    public function isAdmin (){

        return $this->type == 'admin';
    }

    public function isStaff (){
        return $this->type == 'staff';
    }

    public function isOthers (){
        return $this->type == 'others';
    }

}
