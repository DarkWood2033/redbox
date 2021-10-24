<?php

namespace Modules\Administrator\UI\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Modules\Administrator\Repositories\Administrator\AdministratorRepository;
use Modules\Administrator\Services\Administrator\AdministratorService;
use Modules\Administrator\Services\Administrator\DTOs\CreateAdministratorDTO;
use Modules\Administrator\Services\Administrator\DTOs\UpdateAdministratorDTO;
use Modules\Administrator\UI\Http\Requests\StoreRequest;
use Modules\Administrator\UI\Http\Requests\UpdateRequest;

class CrudAdministratorController
{
    public function __construct(
        private AdministratorService $administratorService,
        private AdministratorRepository $administratorRepository
    ) {}

    public function index(): Factory|View|Application
    {
        return view('administrator::Index', [
            'administrators' => $this->administratorRepository->getAll()
        ]);
    }

    public function show($id): Factory|View|Application
    {
        $administrator = $this->administratorRepository->findById($id);
        return view('administrator::Show', [
            'administrator' => $administrator
        ]);
    }

    public function create(): Factory|View|Application
    {
        return view('administrator::Create');
    }

    public function store(StoreRequest $request): Redirector|Application|RedirectResponse
    {
        $DTO = new CreateAdministratorDTO($request->get('email'), $request->get('password'));
        if($administrator = $this->administratorService->create($DTO)){
            return redirect(route('administrators.show', ['id' => $administrator->getId()]));
        }
        return back()->with('error', 'Не удалось создать администратора');
    }

    public function edit($id): Factory|View|Application
    {
        $administrator = $this->administratorRepository->findById($id);
        return view('administrator::Edit', [
            'administrator' => $administrator
        ]);
    }

    public function update($id, UpdateRequest $request): Factory|View|Application
    {
        $administrator = $this->administratorRepository->findById($id);
        $DTO = new UpdateAdministratorDTO($request->get('email'));
        $this->administratorService->update($administrator, $DTO);
        return view('administrator::Show', ['administrator' => $administrator]);
    }

    public function destroy($id): Redirector|Application|RedirectResponse
    {
        $administrator = $this->administratorRepository->findById($id);
        if($this->administratorService->remove($administrator)){
            return redirect(route('administrators.index'));
        }
        return redirect(route('administrators.Show', ['id' => $id]));
    }
}
