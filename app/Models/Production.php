<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    protected $fillable = [
        'operator_id', 'product_id', 'shift_id', 'production_date',
        'qty_ok', 'qty_ng', 'total_qty', 'status', 'validated_by', 'validated_at', 'note'
    ];

    protected $casts = [
        'production_date' => 'date',
        'validated_at' => 'datetime',
    ];

    public function operator()
    {
        return $this->belongsTo(User::class,'operator_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class,'validated_by');
    }
}
