<?php

namespace Modules\Auth\UI\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ResetPasswordRequest extends FormRequest
{
    #[ArrayShape(['email' => "string[]", 'hash' => "string[]", 'password' => "string[]"])]
    public function rules(): array
    {
        return [
            'email' => ['required'],
            'hash' => ['required'],
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ];
    }
}
