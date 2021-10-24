<?php

namespace App\Auth;

use Doctrine\ORM\Mapping as ORM;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Modules\Administrator\Entities\Administrator;
use Modules\Manager\Entities\Manager;

#[ORM\Entity]
#[ORM\Table('users')]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'role', type: 'string')]
#[ORM\DiscriminatorMap([
    RoleEnum::ADMINISTRATOR => Administrator::class,
    RoleEnum::MANAGER => Manager::class
])]
class User implements AuthenticatableContract
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected int $id;

    #[ORM\Column(type: 'string', unique: true)]
    protected string $email;

    #[ORM\Column(type: 'string')]
    protected string $password;

    #[ORM\Column(type: 'string', nullable: true)]
    protected ?string $remember_token;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = bcrypt($password);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getAuthIdentifierName(): string
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        $name = $this->getAuthIdentifierName();

        return $this->{$name};
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password): static
    {
        $this->password = bcrypt($password);
        return $this;
    }

    public function getAuthPassword(): string
    {
        return $this->getPassword();
    }

    public function getRememberToken(): ?string
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName(): string
    {
        return 'remember_token';
    }
}
