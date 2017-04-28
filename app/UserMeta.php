<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'key', 'value',
    ];

    public function user(){

        return $this->belongsTo(User::class);

    }

    public static function saveMeta($user_id, $meta_data){

        UserMeta::where('user_id', $user_id)->delete();

        foreach($meta_data as $key => $val) {

            if ($val) {

                $userMeta = new UserMeta;
                $userMeta->user_id = $user_id;
                $userMeta->key = $key;
                $userMeta->value = $val;
                $userMeta->save();

            }
            
        }

    }
}
