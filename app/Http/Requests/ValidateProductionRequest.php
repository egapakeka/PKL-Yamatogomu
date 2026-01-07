<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateProductionRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() && $this->user()->hasRole('supervisor');
    }

    public function rules()
    {
        return [
            'note' => 'nullable|string|max:1000'
        ];
    }
}
