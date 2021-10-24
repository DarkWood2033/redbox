<?php

namespace Modules\Client\Repositories\Client;

use Modules\Client\Entities\Client;

interface ClientRepository
{
    public function save(Client $client): bool;

    public function remove(Client $client): bool;

    public function getByPhoneNumber(string $phone_number): ?Client;

    /**
     * @return Client[]
     */
    public function getAll(): array;

    public function findById($id): Client;

    public function findByHash($hash): Client;
}
