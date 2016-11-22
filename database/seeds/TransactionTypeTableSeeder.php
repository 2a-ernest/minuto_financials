<?php

use Illuminate\Database\Seeder;

class TransactionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        factory(App\TransactionType::class,1)->create(['type' => 'backing__acc_transfer' ]);
        factory(App\TransactionType::class,1)->create(['type' => 'metals_acc_transfer' ]);
        factory(App\TransactionType::class,1)->create(['type' => 'asset_acc_transfer' ]);
        // factory(App\TransactionType::class,1)->create(['type' => 'backing__acc_transfer' ]);
        // factory(App\TransactionType::class,1)->create(['type' => 'backing__acc_transfer' ]);
        // factory(App\TransactionType::class,1)->create(['type' => 'backing__acc_transfer' ]);
    }
}
