<?php

namespace Modules\Auth\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetLinkMail extends Mailable
{
    public function __construct(
        private string $link
    ) {}

    public function build(): ResetLinkMail
    {
        return $this->view('auth::Mail.ResetLink', [
            'link' => $this->link
        ]);
    }
}
