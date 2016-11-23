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
    	return $this->hasMany('App\Transaction','credit_account_id');
    }

    public function account_type(){
      return $this->belongsTo('App\AccountType','account_type_id');
    }

    //this is a dupliate for eloquent relationship that use type
    public function type(){
      return $this->belongsTo('App\AccountType','account_type_id');
    }

    public function debit_balance(){
      $debits_sum = 0;

      //sum for debits_sum
      foreach (Transaction::where('debit_account_id',$this->id)->get() as $debit) {
        $debits_sum += $debit->amount;
      }

      return $debits_sum;
    }

    public function credit_balance(){
      $credit_sum = 0;

      //sum for debits_sum
      foreach (Transaction::where('credit_account_id',$this->id)->get() as $credit) {
        $credit_sum += $credit->amount;
      }

      return $credit_sum;
    }


    public function balance(){
      //sum of debits minus sum of credit

      return $this->debit_balance() - $this->credit_balance();

    }

}
