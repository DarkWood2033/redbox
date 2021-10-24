<?php

namespace Modules\Client\UI\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Modules\Client\Repositories\Client\ClientRepository;
use Modules\Client\Repositories\Discount\DiscountRepository;
use Modules\Client\Services\Visit\VisitService;
use Modules\Client\UI\Http\Requests\FixRequest;

class VisitController
{
    public function __construct(
        private VisitService $visitService,
        private ClientRepository $clientRepository,
        private DiscountRepository $discountRepository
    ) {}

    public function form($hash): Factory|View|Application
    {
        $clint = $this->clientRepository->findByHash($hash);
        return view('client::Calculate', [
            'client' => $clint,
            'discount' => $this->discountRepository->getByCountVisit(
                $clint->getCountVisits() + 1
            )
        ]);
    }

    public function fix($client_id, FixRequest $request): Redirector|Application|RedirectResponse
    {
        $client = $this->clientRepository->findById($client_id);
        if($this->visitService->fix($client, $request->get('amount'))){
            return redirect(route('visits.form', ['hash' => $client->getHash()]))->with('message', 'Вы успешно добавили посещение');
        }
        return redirect(route('visits.form', ['hash' => $client->getHash()]))->with('message', 'Не удалось добавить посещение');
    }
}
