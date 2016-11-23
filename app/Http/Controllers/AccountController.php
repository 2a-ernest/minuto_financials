<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $accounts = Account::with('account_type','account_holder')->get();

        //ffind debit,credit and balance for all accounts
        foreach ($accounts as $account) {
          $account->debit_balance = $account->debit_balance();
          $account->credit_balance = $account->credit_balance();
          $account->balance = $account->balance();
        }
        return response()->json($accounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $account = Account::with('type','debit_transactions.transaction_type','credit_transactions.transaction_type')->find($id);
        $account->debit_balance = $account->debit_balance();
        $account->credit_balance = $account->credit_balance();
        $account->balance = $account->balance();


        return response()->json($account);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //

        $options = ['1'=>'delete','2'=>'restore','3'=>'forceDelete'];
        $client = Account::find($id);
        //check that input contains delete_option_code
        if($request->has('delete_option_code')){
            //perform action acordingly
            // $delete_option = ;
            $client->$options[$request->input('delete_option_code')]();
        }
        return response()->json($client);
    }
}
