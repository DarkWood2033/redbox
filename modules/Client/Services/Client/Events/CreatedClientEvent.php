<?php

namespace Modules\Client\Services\Client\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Client\Entities\Client;

class CreatedClientEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        private Client $client
    ) {}

    public function getClient(): Client
    {
        return $this->client;
    }
}
