<?php

namespace Modules\Auth\Tasks;

use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Auth\Entities\ResetPassword;
use Modules\Auth\Mail\ResetLinkMail;
use Modules\Auth\Repositories\ResetPassword\ResetPasswordRepository;

class SendResetLinkTask
{
    const RESET_ROUTE = 'reset_password.form';

    public function __construct(
        private ResetPasswordRepository $resetPasswordRepository
    ) {}

    public function run(string $email): bool
    {
        $this->removePreviousLink($email);
        if($link = $this->generateLink($email)){
            return $this->sendMail($email, $link);
        }
        return false;
    }

    private function sendMail(string $email, string $link): bool
    {
        try {
            Mail::to($email)->send(new ResetLinkMail($link));
        }catch (Exception $exception){
            return false;
        }
        return true;
    }

    private function generateLink(string $email): ?string
    {
        $hash = $this->generateHash();
        $reset_password = new ResetPassword($email, $hash);
        if($this->resetPasswordRepository->save($reset_password)){
            return route(self::RESET_ROUTE, [
                'email' => $email,
                'hash' => $hash
            ]);
        }
        return null;
    }

    private function generateHash(): string
    {
        return Str::random(32);
    }

    private function removePreviousLink(string $email)
    {
        foreach($this->resetPasswordRepository->getAllByEmail($email) as $reset_password){
            $this->resetPasswordRepository->remove($reset_password);
        }
    }
}
