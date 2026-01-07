<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = ['name','start_time','end_time','created_by'];

    protected $casts = ['start_time' => 'string', 'end_time' => 'string'];

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
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
