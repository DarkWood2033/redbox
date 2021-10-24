<?php

namespace Modules\Client\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('visits')]
class Visit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'integer')]
    private int $amount;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'visits')]
    private Client $client;

    public function __construct(Client $client, int $amount)
    {
        $this->client = $client;
        $this->amount = $amount;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
