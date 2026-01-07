<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateProductionRequest;
use App\Models\Production;
use App\Services\ProductionService;

class SupervisorController extends Controller
{
    protected $service;

    public function __construct(ProductionService $service)
    {
        $this->service = $service;
    }

    public function dashboard()
    {
        $productions = Production::with('operator','product','shift')
            ->orderBy('production_date','desc')
            ->paginate(50);

        // Add aggregates for charts
        $summary = Production::selectRaw('product_id, SUM(qty_ok) as ok, SUM(qty_ng) as ng')
            ->groupBy('product_id')
            ->with('product')
            ->get();

        return view('supervisor.dashboard', compact('productions','summary'));
    }

    public function validate(ValidateProductionRequest $request, Production $production)
    {
        $this->service->validate($production, $request->user(), $request->input('note'));
        return redirect()->back()->with('success','Production validated');
    }
}
