<?php

namespace App\Models;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(Transaction::class);
    }

    public function getTotalAmountAttribute()
    {
        $transactions = $this->transactions()->get();
        $total = $transactions->reduce(function ($total, $transaction) {
            if ($transaction->type === Transaction::TYPE_WITHDRAW) {
                return $total -= $transaction->value;
            }
            return $total += $transaction->value;
        }, 0);

        return $total;
    }
}
