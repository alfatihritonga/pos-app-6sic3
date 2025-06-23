<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();

        return view('pages.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('pages.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('product.index');
    }

    public function edit(string $productId)
    {
        $product = Product::find($productId);
        return view('pages.product.edit',compact('product'));
    }

    public function update(Request $request, string $productId)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $product = Product::find($productId);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        return redirect()->route('product.index');
    }
    
    public function destroy(string $productId)
    {
        $product = Product::find($productId);
        $product->delete();
        
        return redirect()->route('product.index');
    }
}
