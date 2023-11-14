<?php

namespace App\Repositories\Interfaces;

interface IUserRepository extends IBaseRepository
{
    public function showByEmail(string $email);
}
