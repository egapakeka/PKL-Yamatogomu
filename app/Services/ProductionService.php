<?php

namespace App\Services;

use App\Models\Production;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductionService
{
    public function create(array $data, User $operator): Production
    {
        if ($data['production_date'] !== now()->format('Y-m-d')) {
            throw ValidationException::withMessages(['production_date' => 'Only today is allowed']);
        }

        $data['operator_id'] = $operator->id;
        $data['total_qty'] = ($data['qty_ok'] ?? 0) + ($data['qty_ng'] ?? 0);
        $data['status'] = 'pending';

        return DB::transaction(function () use ($data, $operator) {
            $production = Production::create($data);
            AuditService::log($operator, 'created', $production, [], $production->toArray());
            return $production;
        });
    }

    public function update(Production $production, array $data, User $operator): Production
    {
        if ($production->status === 'validated') {
            throw ValidationException::withMessages(['production' => 'Cannot edit validated record']);
        }

        if ($production->production_date->format('Y-m-d') !== now()->format('Y-m-d')) {
            throw ValidationException::withMessages(['production_date' => 'Only today\'s records can be edited']);
        }

        $old = $production->getOriginal();
        $data['total_qty'] = ($data['qty_ok'] ?? $production->qty_ok) + ($data['qty_ng'] ?? $production->qty_ng);

        return DB::transaction(function () use ($production, $data, $operator, $old) {
            $production->update($data);
            AuditService::log($operator, 'updated', $production, $old, $production->getChanges());
            return $production;
        });
    }

    public function validate(Production $production, User $supervisor, string $note = null): Production
    {
        if ($production->status === 'validated') {
            throw ValidationException::withMessages(['production' => 'Already validated']);
        }

        $old = $production->getOriginal();

        return DB::transaction(function () use ($production, $supervisor, $note, $old) {
            $production->status = 'validated';
            $production->validated_by = $supervisor->id;
            $production->validated_at = now();
            if ($note) $production->note = $note;
            $production->save();

            AuditService::log($supervisor, 'validated', $production, $old, $production->toArray());

            return $production;
        });
    }
}
