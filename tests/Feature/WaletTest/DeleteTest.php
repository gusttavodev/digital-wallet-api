<?php

use App\Models\Wallet;
use App\Http\Resources\WalletResource;

beforeEach(function () {
    $this->user  = newUser();
    $this->wallet = Wallet::factory()->create([
        'user_id' => $this->user->id
    ]);
});

it('should be delete wallet with auth user', function () {
    $this->deleteJson(route('wallet.destroy', $this->wallet->id))
        ->assertStatus(200);

    $this->assertDatabaseMissing('wallets', $this->wallet->toArray());
});
it('should be not found wallet to delete', function () {
    $this->deleteJson(route('wallet.destroy', $this->wallet->id+1))
        ->assertStatus(404);

    $this->assertDatabaseHas('wallets', $this->wallet->toArray());
});
