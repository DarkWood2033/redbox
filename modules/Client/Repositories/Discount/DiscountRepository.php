<?php

namespace Modules\Client\Repositories\Discount;

use Modules\Client\Entities\Discount;

interface DiscountRepository
{
    public function getByCountVisit(int $count_visit): ?Discount;
}
