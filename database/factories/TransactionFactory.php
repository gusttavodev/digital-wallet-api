<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition()
    {
        return [
            'amount' => $this->faker->randomDigitNotNull(50, 500),
            'type' => collect(Transaction::TYPES)->random()
        ];
    }
}
