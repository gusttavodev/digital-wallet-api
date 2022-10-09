<?php

use App\Models\Wallet;
use App\Http\Resources\WalletResource;

beforeEach(function () {
    $this->user  = newUser();
    $this->wallet = Wallet::factory()->create([
        'user_id' => $this->user->id
    ]);
});

it('should be update wallet with auth user', function () {
    $data = getWalletDataUpdate();

    $this->putJson(route('wallet.update', $this->wallet->id), $data)
        ->assertStatus(200);

    $this->assertDatabaseMissing('wallets', $this->wallet->toArray());
    $this->assertDatabaseHas('wallets', $data);
});

it('should be not update wallet with not send required fields', function ($field, $error) {
    $params = getWalletDataUpdate([
          $field => null,
      ]);

    $response = $this->putJson(route('wallet.update', $this->wallet->id), $params)
        ->assertStatus(422);
    $expected = __('validation.required', [
        'attribute' => $field,
    ]);

    expect($response->json()['errors'])->toEqual(
        [
            $field => [$expected]
        ]
    );
})->with([
    ['name', 'name']
]);


function getWalletDataUpdate(array $data = []): array
{
    return array_merge(
        Wallet::factory()->make()->toArray(),
        $data
    );
}
