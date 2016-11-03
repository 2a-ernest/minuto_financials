<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //table truncations


        factory(App\UserType::class,1)->create(['type'=>'admin','description'=>'responsible for managing and setting configuration of system']);
        factory(App\UserType::class,1)->create(['type'=>'employee','description'=>'responsible for managing and setting configuration of system']);
        factory(App\UserType::class,1)->create(['type'=>'client','description'=>'responsible for managing and setting configuration of system']);
        // factory(App\UserType::class,1)->create(['type'=>'admin','description'=>'responsible for managing and setting configuration of system']);
        //make one admin
        factory(App\User::class,1)->create(['email'=>'admin@minuto.com','user_type_id'=>'1']);
        factory(App\User::class,1)->create(['email'=>'employee@minuto.com','user_type_id'=>'2']);
        factory(App\User::class,1)->create(['email'=>'client@minuto.com','user_type_id'=>'3']);
        factory(App\User::class,20)->create(['user_type_id'=>'3']);

        //make account type
       	$accTypes = ['banking_acc','loan_acc','susu_acc','asset_acc','metals_acc'];
        foreach ($accTypes as $accType) {
        	factory(App\AccountType::class,1)->create(['type'=>$accType]);
        }

        //create seed acounts or client
        factory(App\Account::class,90)->create();
        // factory(App\Account::class,1)->create(['user_id'=>App\User::where('email','client@minuto.com')->get()->first()->id);
    }
}
