<?php

use App\Models\Wallet;

it('should be list wallets', function () {
    $user = newUser();
    $user->wallets()->create(Wallet::factory()->make());
    $response = $this->get('/walet');

    $response->assertStatus(200);
});
