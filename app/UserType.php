<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function users(){
    	return $this->hasMany('App\User');
    }
}
