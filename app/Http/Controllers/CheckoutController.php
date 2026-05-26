<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\CartService;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    //
    protected $cartService;

    public function __construct(CartService $cartService)
    {
         $this->cartService = $cartService ;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->total();
        $subtotal = $this->cartService->subtotal();
        $deliveryFee = $this->cartService->deliveryFee();
        $count = $this->cartService->count();
        // dd($cart);
        return view('cart.checkout', compact('cart', 'total', 'subtotal', 'deliveryFee', 'count'));
    }

    public function processCheckout(StoreOrderRequest $request)
    {
        try{

            //wrap in dbtransaction
            DB::beginTransaction();

            $data = $request->validated();
            //implement order creation logic
            
            $cart = $this->cartService->getCart();
        
            //check if cart is empty
            if(empty($cart)){
                Log::warning('Attempted to create order from empty cart');

                return null;
            }

            $total = $this->cartService->total();

            //generate unique order reference
            $reference = 'YUM' . Str::upper(Str::random(10));

            $order = Order::create([
                'transaction_ref' => $reference,
                'customer_name'=> $data['customer_name'],
                'customer_phone'=> $data['customer_phone'],
                'customer_address'=>$data['customer_address'],
                'total_amount'=> $total,
                'status'=> 'pending',
                'payment_status'=> 'pending'
            ]);

            //create orderitems from order
            foreach($cart as $productId => $key){
                $order->orderItems()->create([
                    'order_id' => $order->id,
                    'product_id' => $key['product_id'],
                    'quantity' => $key['quantity'],
                    'price'=> $key['price']
                ]);
            }
            // clear cart
            $this->cartService->clear();
            //dbcommit
            DB::commit();

            Log::info('Order created successfully. Order info:', [
                'order_id' => $order->id,
                'transaction_ref' => $reference,
                'total' => $total
            ]);

            $order->load('orderItems.product');

            $message = $this->buildWhatsappMessage($order);

            $phoneNumber = "2349073371290";

            $whatsappLink = generateWhatsAppLink($phoneNumber, $message);

            // Redirect to WhatsApp
            return redirect()->away($whatsappLink);
            
            // return $order;
        }catch(\Exception $e){
            DB::rollBack();
            // Log::error('Failed to create order', ['error' => $e->getMessage()]);
            // return null;
            dd($e->getMessage(), $e->getTraceAsString());
        }
        

    }

    public function buildWhatsappMessage($order)
    {
        $message = "Hello! I'd like to place an order:\n\n";
        $message .= "Order Reference: {$order->transaction_ref}\n\n";
        $message .= "Items:\n";

        foreach($order->orderItems as $item) {
            $subtotal = $item->quantity * $item->price;
            $message .= "- {$item->product->name} x{$item->quantity} = ₦" . number_format($subtotal, 2) . "\n";
        }

        $message .= "\nDelivery Fee: ₦" . number_format($this->cartService->deliveryFee(), 2) . "\n";
        $message .= "Total: ₦" . number_format($order->total_amount, 2) . "\n\n";
        
        $message .= "Delivery Address:\n{$order->customer_address}\n\n";
        $message .= "Customer: {$order->customer_name}\n";
        $message .= "Phone: {$order->customer_phone}";

        return $message;
    }

}
