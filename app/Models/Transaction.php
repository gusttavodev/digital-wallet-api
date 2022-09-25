<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Transaction extends Model
{
    use HasFactory;

    const TYPE_WITHDRAW = 'withdraw';
    const TYPE_DEPOSIT = 'deposit';

    const TYPES = [
        self::TYPE_WITHDRAW,
        self::TYPE_DEPOSIT
    ];

    public function wallets(): BelongsToMany
    {
        return $this->belongsToMany(Wallet::class);
    }
}
