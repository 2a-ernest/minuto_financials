<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Transaction extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function credit_account(){
    	return $this->belongsTo('App\Account','credit_account_id');
    }

    public function debit_account(){
    	return $this->belongsTo('App\Account','debit_account_id');
    }

    public function transaction_type(){
    	return $this->belongsTo('App\TransactionType');
    }
}
