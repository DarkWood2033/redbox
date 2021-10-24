<?php

namespace Modules\Client\Repositories\Visit;

use Modules\Client\Entities\Visit;

interface VisitRepository
{
    public function save(Visit $visit): bool;
}
