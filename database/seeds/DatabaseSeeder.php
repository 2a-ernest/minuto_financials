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
        factory(App\User::class,1)->create(['fname'=>'Ernest','lname'=>'Asare-Asiedu','email'=>'asieduernest@minuto.com','user_type_id'=>'1']);
        factory(App\User::class,1)->create(['fname'=>'employee','lname'=>'','email'=>'employee@minuto.com','user_type_id'=>'2']);
        factory(App\User::class,1)->create(['fname'=>'employee','lname'=>'','email'=>'client@minuto.com','user_type_id'=>'3']);

        //make account type
       	$accTypes = ['banking_acc','loan_acc','susu_acc','asset_acc','metals_acc'];
        foreach ($accTypes as $accType) {
        	factory(App\AccountType::class,1)->create(['type'=>$accType]);
        }
    }
}
