<?php

namespace Modules\Client\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;

class ClientException extends Exception
{
    #[Pure]
    public static function notFoundById($id): ClientException
    {
        return new ClientException("Не удалось найти клиент с идентификатором ($id)", 404);
    }

    #[Pure]
    public static function notFoundByHash($hash): ClientException
    {
        return new ClientException("Не удалось найти клиент с хэшем ($hash)", 404);
    }

    public function render()
    {
        abort($this->code, $this->getMessage());
    }
}
