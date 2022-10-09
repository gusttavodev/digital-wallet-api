<?php

use App\Models\Wallet;
use Laravel\Sanctum\Sanctum;
use App\Http\Resources\WalletResource;

it('should be list user wallets', function () {
    $anotherUser  = newUser();
    $currentUser  = newUser();

    Wallet::factory(5)->create([
        'user_id' => $anotherUser->id
    ]);
    $wallets = Wallet::factory(5)->create([
        'user_id' => $currentUser->id
    ]);

    $response = $this->getJson(route('wallet.index'))
        ->assertStatus(200);
    $collection = WalletResource::collection($wallets);

    expect($response->json())->toEqual(
        $collection->response()->getData(true)
    );
});

it('should be not list wallets with not auth', function () {
    $this->getJson(route('wallet.index'))->assertStatus(401);
});
