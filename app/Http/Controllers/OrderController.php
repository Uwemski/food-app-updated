<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;

class OrderController extends Controller
{
    //
    //index method
    public function index()
    {
        // dd('xxhxhxgxgggygs');
        $orders = Order::with('orderItems.product')->latest()->paginate(15);

        // dd($orders);
        return view('admin.orders.index', compact('orders'));
    }

    public function show( Order $order){
        // Route model binding makes iteasier
        // $order = Order::findOrFail($id)->paginate(8);
        // dd($order);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        // dd('dfoefkokfok');

        $data = $request->validate([
            'status' => 'required'
        ]);
        
        $oldStatus = $order->status;
        $newStatus = $data['status'];

        if($oldStatus !== 'confirmed' && $newStatus == 'confirmed'){
            // update quantity
            foreach($order->orderItems as $item){
                $product = Product::lockForUpdate()->find($item->product_id);

                if($product->quantity < $item->quantity){
                    throw new Exception('Insufficient stock');
                }

                $product->decrement('quantity', $item->quantity);
            }
            $order->update($data);

            return redirect()->back()->with('status_success', 'status updated successfully');
        }
        // }elseif($order->status =='confirmed' && $request->status=='delivered'){
        //     $order->update($data);
        //     return redirect()->back()->with('status_success', 'status updated successfully');
        // }elseif($order->status == 'confirmed' && $request->status == 'cancelled'){
        //     // restock
        //     foreach($order->orderItems as $item){
        //         $product = Product::lockForUpdate()->find($item->product_id);
        //         $product->increment('quantity', $item->quantity);
        //     }
        //     $order->update($data);
        //     return redirect()->back()->with('status_success', 'status updated successfully');
    
        //     }

        if (in_array($oldStatus, ['confirmed', 'processing']) && $newStatus === 'cancelled') {

            // restock
            foreach($order->orderItems as $item){
                $product = Product::lockForUpdate()->find($item->product_id);
                $product->increment('quantity', $item->quantity);
            }
            $order->update($data);
            return redirect()->back()->with('status_success', 'status updated successfully');
        }
    }

    public function updatePayment(Request $request, Order $order)
    {
        // dd('ussxsxsxsuxsy');
        $data = $request->validate([
            'payment_status' => 'required',
        ]);
        // dd($data);
        $order->update($data);

        return redirect()->back()->with('p-success', 'Payment status updated');
    }
}
