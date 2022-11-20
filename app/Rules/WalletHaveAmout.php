<?php

namespace App\Rules;

use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Contracts\Validation\Rule;

class WalletHaveAmout implements Rule
{
    protected ?string $message;
    protected ?string $type;
    protected ?string $walletId;

    public function __construct($type, $walletId)
    {
        $this->type = $type;
        $this->walletId = $walletId;
    }

    public function passes($attribute, $value)
    {
        $valid = $this->validateAmount($value);

        if ($this->type === Transaction::TYPE_BETWEEN_WALLETS && $valid) {
            return $this->validateFromWalletAmount($value);
        }

        return $valid;
    }

    public function message()
    {
        return $this->message;
    }

    private function validateAmount($amount): bool
    {
        // if ($amount <= 0) {
        //     $this->message = "O valor precisa ser maior que zero";
        //     return false;
        // }

        if ($this->type === Transaction::TYPE_WITHDRAW) {
            if ($amount > Wallet::find($this->walletId)->totalAmount) {
                $this->message = "Você não tem esse valor nessa carteira";
                return false;
            }
        }

        return true;
    }

    private function validateFromWalletAmount($value)
    {
    }
}
