<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminProductRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() && $this->user()->hasRole('admin');
    }

    public function rules()
    {
        return [
            'code' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'is_active' => 'sometimes|boolean'
        ];
    }
}
