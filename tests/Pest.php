<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class)->in('Feature');
uses(RefreshDatabase::class)->in('Feature');


expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});


function something()
{
    // ..
}

function newUser(array $data = []):User
{
    $user = User::factory()->create($data);
    Sanctum::actingAs(
        $user
    );
    return $user;
}
