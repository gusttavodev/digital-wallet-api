<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    public function run()
    {
        // for ($i=0; $i < 30; $i++) {
        //     User::all()->each(
        //         fn ($value) => $value->wallets()->create(
        //             Wallet::factory()->make()->toArray()
        //         )
        //     );
        // }
    }
}
