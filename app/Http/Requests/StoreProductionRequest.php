<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class StoreProductionRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() && $this->user()->hasRole('operator');
    }

    public function rules()
    {
        $activeProductIds = Product::active()->pluck('id')->toArray();

        return [
            'product_id' => ['required','integer','in:'.implode(',',$activeProductIds)],
            'shift_id' => 'required|integer|exists:shifts,id',
            'production_date' => 'required|date|in:'.now()->format('Y-m-d'),
            'qty_ok' => 'required|integer|min:0',
            'qty_ng' => 'required|integer|min:0',
            'note' => 'nullable|string|max:1000'
        ];
    }
}
