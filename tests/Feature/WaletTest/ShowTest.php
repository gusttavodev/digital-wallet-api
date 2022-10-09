<?php

use App\Models\Wallet;
use App\Http\Resources\WalletResource;

it('should be show wallet from user', function () {
    $user  = newUser();
    $wallet = Wallet::factory()->create([
       'user_id' => $user->id
    ]);

    $response = $this->get(route('wallet.show', $wallet->id))
        ->assertStatus(200);

    $expected = new WalletResource($wallet);
    expect($response->json())->toEqual(
        $expected->response()->getData(true)
    );
});

it('should be not show wallet from another user', function () {
    $wallet = Wallet::factory()->create([
       'user_id' => newUser()->id
    ]);

    newUser();
    $this->get(route('wallet.show', $wallet->id))
        ->assertStatus(404);
});
