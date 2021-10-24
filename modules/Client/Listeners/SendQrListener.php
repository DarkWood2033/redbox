<?php

namespace Modules\Client\Listeners;

use App\QrCode\QrCode;
use App\SmsSending\SmsSending;
use Modules\Client\Services\Client\Events\CreatedClientEvent;

class SendQrListener
{
    public function __construct(
        private QrCode $qrCode,
        private SmsSending $smsSending
    ) {}

    public function handle(CreatedClientEvent $event)
    {
        $client = $event->getClient();
        $this->smsSending->send(
            '+'.$client->getPhoneNumber(),
            $this->qrCode->generateUrl(
                route('visits.form', ['hash' => $client->getHash()])
            )
        );
    }
}
