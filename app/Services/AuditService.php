<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class AuditService
{
    public static function log(?User $user, string $event, Model $model, $old = null, $new = null)
    {
        AuditLog::create([
            'user_id' => $user?->id,
            'auditable_type' => get_class($model),
            'auditable_id' => $model->getKey(),
            'event' => $event,
            'old_values' => $old ? json_encode($old) : null,
            'new_values' => $new ? json_encode($new) : null,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
    }
}
