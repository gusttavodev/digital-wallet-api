<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\WalletResource;
use App\Http\Requests\Wallet\WalletStore;
use App\Http\Requests\Wallet\WalletUpdate;

class WalletController extends Controller
{
    public function index()
    {
        return WalletResource::collection(
            auth()->user()->wallets()->get()
        );
    }

    public function store(WalletStore $request)
    {
        auth()->user()->wallets()->create(
            $request->validated()
        );
    }

    public function show($id): WalletResource
    {
        return new WalletResource(
            auth()->user()->wallets()->findOrFail($id)
        );
    }

    public function update(WalletUpdate $request, $id): void
    {
        auth()->user()
            ->wallets()
            ->findOrFail($id)->update($request->validated());
    }

    public function destroy($id): void
    {
        auth()->user()
            ->wallets()
            ->delete();
    }
}
