<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
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

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart');
        $productId = $request->product_id;
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            $cart[$productId]['subtotal'] = $request->quantity * $cart[$productId]['price'];
        }
        
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function cancel()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Transaksi berhasil dibatalkan.');
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (count($cart) === 0) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }
        
        $total = array_sum(array_column($cart, 'subtotal'));
        
        if ($request->cash < $total) {
            return redirect()->back()->with('error', 'Uang bayar kurang!');
        }
        
        $transaction = Transaction::create([
            'total_price' => $total,
            'cash_received' => $request->cash,
            'change_returned' => $request->cash - $total,
        ]);
        
        foreach ($cart as $item) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal']
            ]);
            
            // kurangi stok produk
            $product = Product::find($item['product_id']);
            $product->stock -= $item['quantity'];
            $product->save();
        }
        
        session()->forget('cart');
        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil disimpan.');
    }
}
