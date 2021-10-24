<?php

namespace Modules\Client\Services\Visit;

use Modules\Client\Entities\Client;
use Modules\Client\Entities\Visit;
use Modules\Client\Repositories\Discount\DiscountRepository;
use Modules\Client\Repositories\Visit\VisitRepository;
use Modules\Client\Services\Client\ClientService;

class VisitService
{
    public function __construct(
        private VisitRepository $visitRepository,
        private ClientService $clientService,
        private DiscountRepository $discountRepository
    ) {}

    public function fix(Client $client, int $amount): bool
    {
        $visit = new Visit($client, $this->getAmountWithDiscount($client, $amount));
        return $this->visitRepository->save($visit);
    }

    private function getAmountWithDiscount(Client $client, int $amount): int
    {
        if($discount = $this->discountRepository->getByCountVisit($client->getCountVisits() + 1)){
            $amountWithDiscount = $amount - $discount->getAmount();
            if($amountWithDiscount <= 0){
                return 0;
            }
            return $amountWithDiscount;
        }
        return $amount;
    }
}
