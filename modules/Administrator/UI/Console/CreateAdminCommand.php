<?php

namespace Modules\Administrator\UI\Console;

use Illuminate\Console\Command;
use Modules\Administrator\Repositories\Administrator\AdministratorRepository;
use Modules\Administrator\Services\Administrator\AdministratorService;
use Modules\Administrator\Services\Administrator\DTOs\CreateAdministratorDTO;

class CreateAdminCommand extends Command
{
    protected $signature = 'administrator:create';

    protected $description = 'Создаёт первого администратора';

    public function handle(AdministratorService $administratorService, AdministratorRepository $administratorRepository)
    {
        $DTO = new CreateAdministratorDTO('admin@admin.net', 'admin');
        if($administratorService->create($DTO)){
            $this->info('Вы успешно создали администратора: логин - admin@admin.net, пароль - admin');
        }else{
            $this->info('Не удалось создать администратора');
        }
    }
}
