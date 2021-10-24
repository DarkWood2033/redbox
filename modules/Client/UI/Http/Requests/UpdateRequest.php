<?php

namespace Modules\Client\UI\Http\Requests;

use App\Validation\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class UpdateRequest extends FormRequest
{
    #[ArrayShape(['name' => "string[]", 'phone_number' => "array"])]
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255']
        ];
    }
}
