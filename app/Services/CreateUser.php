<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUser 
{
    public function make(string $nome, string $email, string $password, string $tipo): User
    {
        $user = User::create([
            'name'     => $nome,
            'email'    => $email,
            'password' => Hash::make($password),
            'tipo'     => $tipo
        ]);

        return $user;
    }
}