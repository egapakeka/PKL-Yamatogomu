<?php

namespace App\Policies;

use App\Models\Production;
use App\Models\User;

class ProductionPolicy
{
    public function update(User $user, Production $production): bool
    {
        // Operators can update their own records for today and if not validated
        if ($user->hasRole('operator')) {
            return $production->operator_id === $user->id
                && $production->production_date->format('Y-m-d') === now()->format('Y-m-d')
                && $production->status !== 'validated';
        }

        // Supervisors and admins can update (corrections) - ensure audit log will capture changes
        return $user->hasAnyRole(['supervisor', 'admin']);
    }

    public function validate(User $user, Production $production): bool
    {
        return $user->hasRole('supervisor');
    }
}
