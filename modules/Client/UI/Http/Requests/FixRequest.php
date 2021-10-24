<?php

namespace Modules\Client\UI\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class FixRequest extends FormRequest
{
    #[ArrayShape(['amount' => "string[]"])]
    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric']
        ];
    }
}
