<?php

namespace Modules\Client\Services\Client\DTOs;

use JetBrains\PhpStorm\Pure;
use Modules\Client\Services\Client\PhoneNumberAdapter;

class CreateClientDTO
{
    public function __construct(
        private string $name,
        private string $phone_number
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    #[Pure]
    public function getPhoneNumber(): string
    {
        return PhoneNumberAdapter::convert($this->phone_number);
    }
}
