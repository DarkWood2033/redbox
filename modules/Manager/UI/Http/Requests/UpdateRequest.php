<?php

namespace Modules\Manager\UI\Http\Requests;

use App\Auth\User;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class UpdateRequest extends FormRequest
{
    #[ArrayShape(['email' => "string[]", 'password' => "string[]"])]
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:'.User::class.',email,'.$this->route('id')]
        ];
    }
}
