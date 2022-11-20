<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Transaction extends Model
{
    use HasFactory;

    const TYPE_WITHDRAW = 'withdraw';
    const TYPE_DEPOSIT = 'deposit';
    const TYPE_BETWEEN_WALLETS = 'between_wallets';


    const TYPES = [
        self::TYPE_WITHDRAW,
        self::TYPE_DEPOSIT,
        self::TYPE_BETWEEN_WALLETS
    ];

    protected $fillable = [
       'amount',
       'type',
       'wallet_to',
       'wallet_from',
    ];


    public function wallets(): BelongsToMany
    {
        return $this->belongsToMany(Wallet::class);
    }

    protected function value(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['amount'] / 100,
            set: fn ($value, $attributes) => $value * 100,
        );
    }
}
