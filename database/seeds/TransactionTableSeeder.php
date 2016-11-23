<?php

use Illuminate\Database\Seeder;

class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // factory(App\Transaction::class,4)->create();

        //random transactions for charge,withdrawal,deposits,and transfer

      $accounts = App\BankingAccount::all();

      $accounts->each(function($acc,$i){
        //deposits
        factory(App\Transaction::class,mt_rand(2,6))->create([
          'transaction_type_id' => App\TransactionType::where('type','banking_acc_deposit')->get()->first()->id,
          'amount' => mt_rand(50,5000),
          'debit_account_id' => null,
          'credit_account_id' => $acc->id,
        ]);

        //withdrawal
        factory(App\Transaction::class,mt_rand(2,6))->create([
          'transaction_type_id' => App\TransactionType::where('type','banking_acc_withdrawal')->get()->first()->id,
          'amount' => mt_rand(50,2000),
          'debit_account_id' => $acc->id,
          'credit_account_id' => null,
        ]);

        // //charge
        factory(App\Transaction::class,mt_rand(2,6))->create([
          'transaction_type_id' => App\TransactionType::where('type','banking_acc_charge')->get()->first()->id,
          'amount' => mt_rand(50,2000),
          'debit_account_id' => App\BankingAccount::where('id','!=',$acc->id)->get()->random()->id,
          'credit_account_id' => $acc->id,
        ]);

        //charge
        factory(App\Transaction::class,mt_rand(2,6))->create([
          'transaction_type_id' => App\TransactionType::where('type','backing_acc_transfer')->get()->first()->id,
          'amount' => mt_rand(50,2000),
          'debit_account_id' => App\BankingAccount::where('id','!=',$acc->id)->get()->random()->id,
          'credit_account_id' => $acc->id,
        ]);



      });
    }
}
