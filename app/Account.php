<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function account_holder(){
    	return $this->belongsTo('App\User','user_id');
    	//account holder is user associated with an account type
    }

    public function debit_transactions(){
    	return $this->hasMany('App\Transaction','debit_account_id');
    }

    public function credit_transactions(){
    	return $this->hasMany('App\Transaction','credt_account_id');
    }

    public function account_type(){
      return $this->belongsTo('App\AccountType','account_type_id');
    }


}
