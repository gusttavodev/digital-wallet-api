<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition()
    {
        return [
            'amount' => $this->faker->numberBetween(1000, 90000),
            'type' => collect(Transaction::TYPES)->random()
        ];
    }
}
