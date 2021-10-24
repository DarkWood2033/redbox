<?php

namespace Modules\Manager\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;

class ManagerException extends Exception
{
    #[Pure]
    public static function notFoundById($id): ManagerException
    {
        return new ManagerException("Не удалось найти менеджера с идентификатором ($id)");
    }

    public function render()
    {
        abort($this->code, $this->getMessage());
    }
}
