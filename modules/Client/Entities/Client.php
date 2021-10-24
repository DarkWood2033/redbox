<?php

namespace Modules\Client\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity]
#[ORM\Table('clients')]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string', unique: true)]
    private string $phone_number;

    #[ORM\Column(type: 'string', unique: true)]
    private string $hash;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Visit::class, cascade: ['remove'])]
    private Collection $visits;

    #[Pure]
    public function __construct(string $name, string $phone_number, string $hash)
    {
        $this->name = $name;
        $this->phone_number = $phone_number;
        $this->hash = $hash;
        $this->visits = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function getCountVisits(): int
    {
        return $this->visits->count();
    }

    public function getCountBuy(): int
    {
        return $this->visits->filter(function(Visit $visit){
            return $visit->getAmount() !== 0;
        })->count();
    }
}
