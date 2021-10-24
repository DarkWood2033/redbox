<?php

namespace Modules\Manager\UI\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Modules\Manager\Repositories\Manager\ManagerRepository;
use Modules\Manager\Services\Manager\DTOs\CreateManagerDTO;
use Modules\Manager\Services\Manager\DTOs\UpdateManagerDTO;
use Modules\Manager\Services\Manager\ManagerService;
use Modules\Manager\UI\Http\Requests\StoreRequest;
use Modules\Manager\UI\Http\Requests\UpdateRequest;

class CrudManagerController
{
    public function __construct(
        private ManagerService $managerService,
        private ManagerRepository $managerRepository
    ) {}

    public function index(): Factory|View|Application
    {
        return view('manager::Index', [
            'managers' => $this->managerRepository->getAll()
        ]);
    }

    public function show($id): Factory|View|Application
    {
        $manager = $this->managerRepository->findById($id);
        return view('manager::Show', [
            'manager' => $manager
        ]);
    }

    public function create(): Factory|View|Application
    {
        return view('manager::Create');
    }

    public function store(StoreRequest $request): Redirector|Application|RedirectResponse
    {
        $DTO = new CreateManagerDTO($request->get('email'), $request->get('password'));
        if($manager = $this->managerService->create($DTO)){
            return redirect(route('managers.show', ['id' => $manager->getId()]));
        }
        return back()->with('error', 'Не удалось создать манаджера');
    }

    public function edit($id): Factory|View|Application
    {
        $manager = $this->managerRepository->findById($id);
        return view('manager::Edit', [
            'manager' => $manager
        ]);
    }

    public function update($id, UpdateRequest $request): Factory|View|Application
    {
        $manager = $this->managerRepository->findById($id);
        $DTO = new UpdateManagerDTO($request->get('email'));
        $this->managerService->update($manager, $DTO);
        return view('manager::Show', ['manager' => $manager]);
    }

    public function destroy($id): Redirector|Application|RedirectResponse
    {
        $manager = $this->managerRepository->findById($id);
        if($this->managerService->remove($manager)){
            return redirect(route('managers.index'));
        }
        return redirect(route('managers.Show', ['id' => $id]));
    }
}
