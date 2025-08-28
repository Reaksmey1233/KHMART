<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        $total = $cartItems->sum('subtotal');

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $userId = Auth::id();
        $productId = $request->product_id;
        $qty = $request->qty;

        // Check if item already exists in cart
        $cartItem = UserCart::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->update(['qty' => $cartItem->qty + $qty]);
        } else {
            UserCart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'qty' => $qty,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, UserCart $cartItem)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->update(['qty' => $request->qty]);

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    public function remove(UserCart $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Item removed from cart!');
    }
}
