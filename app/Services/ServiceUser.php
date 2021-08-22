<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ServiceUser 
{
    public function create(string $nome, string $email, string $password, string $tipo): User
    {
        $user = User::create([
            'name'     => $nome,
            'email'    => $email,
            'password' => Hash::make($password),
            'tipo'     => $tipo
        ]);

        return $user;
    }

    public function update(int $id, string $nome, string $email, ?string $password): User
    {
        $user = User::find($id);             
        $user->name = $nome;
        $user->email = $email;
        $user->name = $nome;

        if (is_null($password)) {            
            $user->password = Hash::make($password);
        }

        $user->save();

        return $user;
    }
}