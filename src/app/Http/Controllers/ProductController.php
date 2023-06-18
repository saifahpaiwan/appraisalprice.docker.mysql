<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        try {
            request()->validate([
                'name' => 'required',
                'detail' => 'required',
            ]);
            Product::create($request->all());
            Log::info('Product created successfully : ' . json_encode($request->all(), true));
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return false;
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    { 
        try {
            request()->validate([
                'name' => 'required',
                'detail' => 'required',
            ]); 
            $product->update($request->all());
            Log::info('Product updated successfully : ' . json_encode($request->all(), true));
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return false;
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        try { 
            Log::info('Product deleted successfully : ' . json_encode($product, true));
            $product->delete();
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return false;
        } 

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
