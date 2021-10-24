<?php

namespace Modules\Auth\Tasks;

use App\Auth\Repositories\UserRepository;
use App\Auth\User;
use DateTime;
use Exception;
use Illuminate\Database\DatabaseTransactionsManager;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Entities\ResetPassword;
use Modules\Auth\Repositories\ResetPassword\ResetPasswordRepository;

class ResetPasswordTask
{
    public function __construct(
        private ResetPasswordRepository $resetPasswordRepository,
        private UserRepository $userRepository
    ) {}

    public function run(string $email, string $hash, string $password): bool
    {
        DB::beginTransaction();
        try {
            $reset_password = $this->resetPasswordRepository->getActiveByEmailAndHash($email, $hash);
            $user = $this->userRepository->getByEmail($email);
            if($reset_password && $user){
                if($this->useThrow($reset_password) && $this->updatePassword($user, $password)){
                    DB::commit();
                    return true;
                }
            }
        }catch(Exception $exception){}
        DB::rollBack();
        return false;
    }

    private function useThrow(ResetPassword $reset_password): bool
    {
        $reset_password->setUsedAt(new DateTime());
        return $this->resetPasswordRepository->save($reset_password);
    }

    private function updatePassword(User $user, string $password): bool
    {
        $user->setPassword($password);
        return $this->userRepository->save($user);
    }
}
