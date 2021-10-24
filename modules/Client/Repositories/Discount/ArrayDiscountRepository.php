<?php

namespace Modules\Client\Repositories\Discount;

use Modules\Client\Entities\Discount;

class ArrayDiscountRepository implements DiscountRepository
{
    public function getByCountVisit(int $count_visit): ?Discount
    {
        foreach($this->getData() as $discount){
            if($discount->getCountVisit() === $count_visit){
                return $discount;
            }
        }
        return null;
    }

    private function getData(): array
    {
        return [
            new Discount(3, 5),
            new Discount(5, 10),
            new Discount(8, 5),
            new Discount(10, 10),
        ];
    }
}
