<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionTarget extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','shift_id','target_qty','effective_from','effective_to','created_by'];

    protected $casts = [
        'effective_from' => 'date',
        'effective_to' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
