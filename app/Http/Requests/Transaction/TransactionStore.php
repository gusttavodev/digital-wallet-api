<?php

namespace App\Http\Requests\Transaction;

use App\Models\Transaction;
use App\Rules\WalletHaveAmout;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TransactionStore extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'amount' => ['required', 'min:0', new WalletHaveAmout($this->type, $this->wallet_id)],
            'type' => ['required', Rule::in(Transaction::TYPES)],

            'wallet_id' => ['required', 'exists:App\Models\Wallet,id'],

            'wallet_to' => [Rule::requiredIf($this->isFromWallet($this->type))],
            'wallet_from' => [Rule::requiredIf($this->isFromWallet($this->type))],
        ];
    }

    private function isFromWallet($type): bool
    {
        return $type === Transaction::TYPE_BETWEEN_WALLETS;
    }
}
