<?php

use App\Models\Wallet;
use App\Http\Resources\WalletResource;

it('should be store wallet with auth user', function () {
    $data = getWalletData();
    $data['user_id'] = newUser()->id;

    $this->postJson(route('wallet.store'), $data)
        ->assertStatus(200);

    $this->assertDatabaseHas('wallets', $data);
});

it('should be not store wallet with not send required fields', function ($field, $error) {
    newUser();

    $params = getWalletData([
        $field => null,
    ]);

    $response = $this->postJson(route('wallet.store'), $params)
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

it('should be not store wallet with not auth', function () {
    $this->postJson(route('wallet.store'))->assertStatus(401);
});


function getWalletData(array $data = []): array
{
    return array_merge(
        Wallet::factory()->make()->toArray(),
        $data
    );
}
