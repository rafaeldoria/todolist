<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\IUserRepositories;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Support\Facades\Hash;

class UserRepositories extends BaseRepository implements IUserRepository
{
    public function store(array $user) {
        return User::create([
            'name' => $user['name'],
            'email' => $user['email'] ,
            'password' => Hash::make($user['password']),
        ]);
    }

    public function showByEmail(string $email) {
        return User::where('email', $email)->first();
    }
}
