<?php

namespace App\Auth\Repositories;

use App\Auth\User;

interface UserRepository
{
    public function save(User $user): bool;

    public function getByEmail(string $email): ?User;
}
