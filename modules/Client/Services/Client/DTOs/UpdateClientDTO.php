<?php

namespace Modules\Client\Services\Client\DTOs;

class UpdateClientDTO
{
    public function __construct(
        private string $name
    ) {}

    public function getName(): string
    {
        return $this->name;
    }
}
