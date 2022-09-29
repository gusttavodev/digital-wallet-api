<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('it should be login user with success', function () {
    $email = "admin@gmail.com";
    $password = "12345678";

    User::factory([
        'email'    => $email,
        'password' => Hash::make($password),
    ])->create();

    $this->postJson(route('login'), [
        'email'    => $email,
        'password' => $password,
    ])->assertStatus(200)->assertJson([
        'token_type' => 'Bearer'
    ]);
    $this->assertEquals(auth()->user(), User::where('email', $email)->first());
});

test('it should be login user error with invalid password', function () {
    $email = "admin@gmail.com";
    $password = "12345678";

    User::factory([
        'email'    => $email,
        'password' => Hash::make($password),
    ])->create();

    $this->postJson(route('login'), [
        'email'    => $email,
        'password' => '123123123',
    ])->assertStatus(401)->assertJson([
        'message' => 'Email ou senha inválidos'
    ]);
});

test('it should be login all required fields', function () {
    $this->postJson(route('login'))->assertStatus(422)->assertJsonValidationErrors(['email', 'password']);
});
