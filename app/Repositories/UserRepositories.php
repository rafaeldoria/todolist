<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\IUserRepositories;
use Illuminate\Support\Facades\Hash;

class UserRepositories extends BaseRepository
{
    public function store(array $user) {
        return User::create([
            'name' => $user['name'],
            'email' => $user['email'] ,
            'password' => Hash::make($user['password']),
        ]);
    }
}
