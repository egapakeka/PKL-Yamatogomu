<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['code','name','is_active','created_by'];

    protected $casts = ['is_active' => 'boolean'];

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function productionTargets()
    {
        return $this->hasMany(ProductionTarget::class);
    }

    public function productions()
    {
        return $this->hasMany(Production::class);
    }
}
