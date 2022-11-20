<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\Transaction\TransactionStore;

class TransactionController extends Controller
{
    public function store(TransactionStore $request)
    {
        $inputs = $request->validated();
        $wallet = Wallet::find($inputs['wallet_id']);

        if (!str_contains($inputs['amount'], '.')) {
            $inputs['amount'] = $inputs['amount']."00";
        } else {
            $inputs['amount'] = round($inputs['amount'], 2)*100;
        }

        if ($inputs['type'] === Transaction::TYPE_BETWEEN_WALLETS) {
            $this->walletTransaction($inputs);
            return;
        }


        $wallet->transactions()->attach(Transaction::create($inputs));
    }

    private function walletTransaction(array $inputs): void
    {
        $fromWallet = Wallet::find($inputs['wallet_from']);
        $toWallet = Wallet::find($inputs['wallet_to']);

        $fromWallet->transactions->attach(Transaction::create([
            'amount' => $inputs['amount'],
            'type' => Transaction::TYPE_WITHDRAW,
            'wallet_to' => $toWallet->id,
            'wallet_from' => $fromWallet->id
        ]));
        $toWallet->transactions->attach(Transaction::create([
           'amount' => $inputs['amount'],
            'type' => Transaction::TYPE_WITHDRAW,
            'wallet_to' => $toWallet->id,
            'wallet_from' => $fromWallet->id
        ]));
    }
}
