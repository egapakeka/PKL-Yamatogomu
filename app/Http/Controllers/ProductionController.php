<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductionRequest;
use App\Http\Requests\UpdateProductionRequest;
use App\Models\Production;
use App\Services\ProductionService;

class ProductionController extends Controller
{
    protected $service;

    public function __construct(ProductionService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
        $products = \App\Models\Product::active()->get();
        $shifts = \App\Models\Shift::all();
        return view('operator.form', compact('products','shifts'));
    }

    public function store(StoreProductionRequest $request)
    {
        $production = $this->service->create($request->validated(), $request->user());
        return redirect()->route('operator.form')->with('success','Production recorded');
    }

    public function edit(Production $production)
    {
        $this->authorize('update', $production);
        return view('operator.edit', compact('production'));
    }

    public function update(UpdateProductionRequest $request, Production $production)
    {
        $production = $this->service->update($production, $request->validated(), $request->user());
        return redirect()->route('operator.form')->with('success','Production updated');
    }
}
