<?php

namespace Modules\Client\Services\Client;

use Illuminate\Support\Str;
use Modules\Client\Entities\Client;
use Modules\Client\Repositories\Client\ClientRepository;
use Modules\Client\Services\Client\DTOs\CreateClientDTO;
use Modules\Client\Services\Client\DTOs\UpdateClientDTO;
use Modules\Client\Services\Client\Events\CreatedClientEvent;

class ClientService
{
    public function __construct(
        private ClientRepository $clientRepository
    ) {}

    public function create(CreateClientDTO $DTO): ?Client
    {
        $client = new Client($DTO->getName(), $DTO->getPhoneNumber(), $this->generateHash());
        if($this->clientRepository->save($client)){
            CreatedClientEvent::dispatch($client);
            return $client;
        }
        return null;
    }

    public function update(Client $client, UpdateClientDTO $DTO): bool
    {
        $client->setName($DTO->getName());
        return $this->clientRepository->save($client);
    }

    public function remove(Client $client): bool
    {
        return $this->clientRepository->remove($client);
    }

    protected function generateHash(): string
    {
        return Str::random(32);
    }
}
