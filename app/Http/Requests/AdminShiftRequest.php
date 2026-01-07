<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminShiftRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() && $this->user()->hasRole('admin');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s'
        ];
    }
}
