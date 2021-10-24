<?php

namespace Modules\Auth\UI\Http\Requests;

use App\Auth\User;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ForgotPasswordRequest extends FormRequest
{
    #[ArrayShape(['email' => "string[]"])]
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:'.User::class.',email']
        ];
    }
}
