<?php

namespace Modules\Administrator\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;

class AdministratorException extends Exception
{
    #[Pure]
    public static function notFoundById($id): AdministratorException
    {
        return new AdministratorException("Не удалось найти администратора с идентификатором ($id)", 404);
    }

    public function render()
    {
        abort($this->code, $this->getMessage());
    }
}
