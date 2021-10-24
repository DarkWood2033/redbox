<?php

namespace Modules\Auth\UI\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class LoginRequest extends FormRequest
{
    protected $redirectRoute = 'login';

    #[ArrayShape(['email' => "string[]", 'password' => "string[]"])]
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ];
    }
}
