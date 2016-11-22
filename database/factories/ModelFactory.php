<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class,function (Faker\Generator $faker) {
    static $password;

    return [
        'fname' => $faker->firstNameFemale,
        'lname' => $faker->lastName,
        'oname' => $faker->monthName().'_Name',
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'user_type_id' => '3',
    ];
});

$factory->define(App\UserType::class, function ($faker){
  return [
    'type'=> $faker->dayofWeek(),
    'description' => $faker->sentence(3),
  ];
});

$factory->define(App\AccountType::class,function($faker){
    return [
        'type' => $faker->monthName().'Type',
        'description' => $faker->sentence(3),
    ];
});

$factory->define(App\Account::class,function($faker){
    return [
        'user_id' => App\UserType::where('type','client')->get()->first()->users->random()->id,//must be supplied when instanciating
        'account_type_id' => App\AccountType::all()->random()->id //must be supplied when instanciating
    ];
});

//for later
$factory->define(App\Transaction::class,function($faker){
    return [
        // 'user_id' => App\UserType::where('type','client')->get()->first()->users->random()->id,//must be supplied when instanciating
        // 'account_type_id' => App\AccountType::all()->random()->id //must be supplied when instanciating
        'transaction_type_id' => App\TransactionType::all()->random()->id,
        'debit_account_id' => function(array $transaction){
          App\TransactionType::find($transaction['transaction_type_id')->accounts->random()->id,
        },
        'credit_account_id' => App\AccountType::where('type','banking_acc')->get()->first()->accounts->random()->id,
        'amount' => $faker->randomFloat(2,30,2000),
        'location' => $faker->address,
        'description' => $faker->sentence(2),
    ];
});

$factory->define(App\TransactionType::class,function($faker){
  return [
    'type'=> '',
    'description' => $faker->sentence(3),
  ];
});
