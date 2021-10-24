<?php

namespace Modules\Client\UI\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Modules\Client\Repositories\Client\ClientRepository;
use Modules\Client\Services\Client\ClientService;
use Modules\Client\Services\Client\DTOs\CreateClientDTO;
use Modules\Client\Services\Client\DTOs\UpdateClientDTO;
use Modules\Client\UI\Http\Requests\StoreRequest;
use Modules\Client\UI\Http\Requests\UpdateRequest;

class CrudClientController
{
    public function __construct(
        private ClientRepository $clientRepository,
        private ClientService $clientService
    ) {}

    public function index(): Factory|View|Application
    {
        $clients = $this->clientRepository->getAll();
        return view('client::Index', [
            'clients' => $clients
        ]);
    }

    public function show($id): Factory|View|Application
    {
        $client = $this->clientRepository->findById($id);
        return view('client::Show', [
            'client' => $client
        ]);
    }

    public function create(): Factory|View|Application
    {
        return view('client::Create');
    }

    public function store(StoreRequest $request): Redirector|Application|RedirectResponse
    {
        $DTO = new CreateClientDTO($request->get('name'), $request->get('phone_number'));
        if($client = $this->clientService->create($DTO)){
            return redirect(route('clients.show', ['id' => $client->getId()]));
        }
        return back()->with('error', 'Не удалось создать администратора');
    }

    public function edit($id): Factory|View|Application
    {
        $client = $this->clientRepository->findById($id);
        return view('client::Edit', [
            'client' => $client
        ]);
    }

    public function update($id, UpdateRequest $request): Factory|View|Application
    {
        $client = $this->clientRepository->findById($id);
        $DTO = new UpdateClientDTO($request->get('name'));
        $this->clientService->update($client, $DTO);
        return view('client::Show', ['client' => $client]);
    }

    public function destroy($id): Redirector|Application|RedirectResponse
    {
        $client = $this->clientRepository->findById($id);
        if($this->clientService->remove($client)){
            return redirect(route('clients.index'));
        }
        return redirect(route('clients.Show', ['id' => $id]));
    }
}
