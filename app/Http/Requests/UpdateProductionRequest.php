<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductionRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() && $this->user()->hasRole('operator');
    }

    public function rules()
    {
        return [
            'qty_ok' => 'sometimes|required|integer|min:0',
            'qty_ng' => 'sometimes|required|integer|min:0',
            'note' => 'nullable|string|max:1000'
        ];
    }
}
