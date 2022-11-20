<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'     => "Admin Silva",
            'email'    => "admin@gmail.com",
            'password' => Hash::make('12345678'),
        ]);
        $this->call(WalletSeeder::class);
        $this->call(TransactionSeeder::class);
    }
}
