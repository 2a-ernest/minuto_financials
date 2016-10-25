<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountType extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function accounts(){
    	return $this->hasMany('App\Account');
    }
}
