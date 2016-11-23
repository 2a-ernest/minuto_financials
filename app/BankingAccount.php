<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;
use App\AccountType;
use App\Account;


class BankingAccount extends Model
{
    //
    protected $table = 'accounts';


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('scope', function(Builder $builder) {
            $builder->where('account_type_id', '=', AccountType::where('type','banking_acc')->get()->first()->id);
        });
    }

    // use SoftDeletes;

    // protected $dates = ['deleted_at'];

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
      foreach ($this->debit_transactions as $debit) {
        $debits_sum += $debit->amount;
      }

      return $debits_sum;
    }

    public function credit_balance(){
      $credit_sum = 0;

      //sum for debits_sum
      foreach ($this->credit_transactions as $credit) {
        $credit_sum += $credit->amount;
      }

      return $credit_sum;
    }


    public function balance(){
      //sum of debits minus sum of credit

      return $this->debit_sum - $this->credit_sum;

    }
}
