<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    public function run()
    {
        User::all()->each(
            fn ($value) => $value->wallets()->create(
                Wallet::factory()->make()->toArray()
            )
        );
    }
}
