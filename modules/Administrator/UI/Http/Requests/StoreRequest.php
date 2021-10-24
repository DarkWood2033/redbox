<?php

namespace Modules\Administrator\UI\Http\Requests;

use App\Auth\User;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class StoreRequest extends FormRequest
{
    #[ArrayShape(['email' => "string[]", 'password' => "string[]"])]
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:'.User::class.',email'],
            'password' => ['required', 'string', 'min:6', 'max:255', 'confirmed']
        ];
    }
}
