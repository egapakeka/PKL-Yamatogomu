<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class AdminUserRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() && $this->user()->hasRole('admin');
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:150',
            'email' => 'required|email',
            'role' => 'required|string|exists:roles,name'
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = 'required|string|min:6';
        }

        return $rules;
    }
}
