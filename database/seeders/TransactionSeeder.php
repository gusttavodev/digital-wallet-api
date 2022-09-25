<?php

namespace Database\Seeders;

use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        Wallet::all()->each(fn ($value) => $value->transactions()->saveMany(
            Transaction::factory(30)->create()
        ));
    }
}
