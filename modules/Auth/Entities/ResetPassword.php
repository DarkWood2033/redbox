<?php

namespace Modules\Auth\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('reset_passwords')]
class ResetPassword
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $email;

    #[ORM\Column(type: 'string')]
    private string $hash;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $used_at;

    public function __construct(string $email, string $hash)
    {
        $this->email = $email;
        $this->hash = $hash;
        $this->used_at = null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function getUsedAt(): ?DateTime
    {
        return $this->used_at;
    }

    public function setUsedAt(DateTime $used_at): static
    {
        $this->used_at = $used_at;
        return $this;
    }
}
