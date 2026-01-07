<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\AdminProductRequest;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    public function index()
    {
        $products = Product::paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(AdminProductRequest $request)
    {
        Product::create($request->validated());
        return redirect()->route('admin.products.index')->with('success','Product created');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(AdminProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return redirect()->route('admin.products.index')->with('success','Product updated');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success','Product deleted');
    }
}
