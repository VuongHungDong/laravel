<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('success', 'Giỏ hàng của bạn đang trống.');
        }

        $total = array_reduce($cart, function($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return view('checkout', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        $total = array_reduce($cart, function($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        DB::beginTransaction();

        try {
            // Create Order
            $order = Order::create([
                'code' => 'ORD-' . strtoupper(uniqid()),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'total_price' => $total,
                'status' => 'pending',
                'user_id' => auth()->id(),
            ]);

            // Create Order Details
            foreach ($cart as $productId => $details) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
            }

            DB::commit();

            // Clear Cart
            session()->forget('cart');

            return redirect()->route('checkout.success')->with('order_id', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            \Illuminate\Support\Facades\Log::error('Checkout Error: ' . $e->getMessage() . ' - Trace: ' . $e->getTraceAsString());
            return back()->with('error', 'Có lỗi xảy ra khi đặt hàng. Vui lòng thử lại.')->withInput();
        }
    }

    public function success()
    {
        if (!session('order_id')) {
            return redirect()->route('welcome');
        }
        return view('checkout_success');
    }
}
