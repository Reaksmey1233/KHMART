<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\UserCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public function checkout()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum('subtotal');

        return view('orders.checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'delivery_address' => 'required|string',
            'phone' => 'required|string',
        ]);

        $cartItems = Auth::user()->cartItems()->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        try {
            DB::beginTransaction();

            $total = $cartItems->sum('subtotal');

            $order = Order::create([
                'user_id' => Auth::id(),
                'date_time' => now(),
                'total' => $total,
                'paid' => false,
                'delivery' => 'pending',
            ]);

            foreach ($cartItems as $cartItem) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'qty' => $cartItem->qty,
                    'price' => $cartItem->product->discounted_price,
                ]);
            }

            // Clear cart
            $cartItems->each->delete();

            DB::commit();

            // Send notification to store owner (Telegram)
            $this->sendTelegramNotification($order);

            // Send invoice to customer (Email)
            $this->sendInvoiceEmail($order);

            return redirect()->route('orders.success', $order)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.success', compact('order'));
    }

    public function index()
    {
        $orders = Auth::user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }

    private function sendTelegramNotification($order)
    {
        // TODO: Implement Telegram notification
        // This would typically use a Telegram Bot API
        \Log::info('Telegram notification sent for order: ' . $order->id);
    }

    private function sendInvoiceEmail($order)
    {
        // TODO: Implement email invoice
        // This would typically use Laravel's Mail facade
        \Log::info('Invoice email sent for order: ' . $order->id);
    }
}
