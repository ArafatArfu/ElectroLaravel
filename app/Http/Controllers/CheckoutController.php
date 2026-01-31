<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Show checkout page.
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        
        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }

    /**
     * Process checkout and create order.
     */
    public function process(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
        ]);

        $cart = Session::get('cart', []);
        
        if (count($cart) === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        DB::beginTransaction();

        try {
            // Create order
            $order = Order::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'zip_code' => $request->zip_code ?? '',
                'notes' => $request->notes ?? '',
                'total' => $total,
                'status' => 'pending',
            ]);

            // Create order items
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'product_price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }

            DB::commit();

            // Clear cart
            Session::forget('cart');

            return redirect()->route('checkout.success', $order->id)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while processing your order. Please try again.');
        }
    }

    /**
     * Show order success page.
     */
    public function success($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);
        return view('checkout-success', compact('order'));
    }
}
