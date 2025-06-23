<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('details')->latest()->get();

        return view('pages.transaction.index', compact('transactions'));
    }

    public function create()
    {
        $categories = Category::with('products')->get();
        $cart = session()->get('cart', []);

        return view('pages.transaction.create', compact('categories', 'cart'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += 1;
            $cart[$product->id]['subtotal'] = $cart[$product->id]['quantity'] * $cart[$product->id]['price'];
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'subtotal' => $product->price
            ];
        }
        
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Berhasil menambah produk kekeranjang.');
    }
}
