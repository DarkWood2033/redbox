<?php

namespace Modules\Client\Entities;

class Discount
{
    public function __construct(
        private int $count_visit,
        private int $amount
    ) {}

    public function getCountVisit(): int
    {
        return $this->count_visit;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}
