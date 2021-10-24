<?php

namespace Modules\Auth\Repositories\ResetPassword;

use Modules\Auth\Entities\ResetPassword;

interface ResetPasswordRepository
{
    public function save(ResetPassword $resetPassword): bool;

    public function remove(ResetPassword $resetPassword): bool;

    public function getActiveByEmailAndHash(string $email, string $hash): ?ResetPassword;

    public function getAllByEmail(string $email): array;
}
