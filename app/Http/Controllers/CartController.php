<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Services\CartService;


class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    //methods

    public function index()
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->total();
        $subtotal = $this->cartService->subtotal();
        $deliveryFee = $this->cartService->deliveryFee();
        $count = $this->cartService->count();

        return view('cart.cart', compact('cart','total','subtotal','count','deliveryFee'));
    }
    //method to add
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);


        $product = Product::findOrFail($validated['product_id']);
        $quantity = $validated['quantity'] ?? 1;

        $this->cartService->add($product, $quantity);
        return response()->json([
            'message' => 'Product added to cart successfully',
            'cart_count' => $this->cartService->count(),
            'cart_total' => $this->cartService->total(),
            'cart_subtotal' => $this->cartService->subtotal(),
        ], 200);
        // return redirect()->back()->with('success', 'product added to cart');
    }

    //method to update
    //yet to be tested
    public function update(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $this->cartService->update($validated['product_id'], $validated['quantity']);

        return response()->json([
            'message' => 'Cart updated!',
            'cart_count' => $this->cartService->count(),
            'cart_total' => $this->cartService->total(),
            'cart_subtotal' => $this->cartService->subtotal(),
        ], 200);
    }

    //method to remove
    public function remove($id)
    {
        $this->cartService->remove($id);

        //redirect
        //you can jsonify later

        return response->json([
            'success' => true,
            'message'=>'Item removed from cart successfully',
        ]);
    }

    //method to clear cart
    public function clear(Request $request)
    {
        $this->cartService->clear();

        // dd('dsdfjijidjois');
        return redirect()->route('menu')->with('success', 'cart cleared successfully');

    }
    
    public function increment(Request $request, $id)
    {
        $this->cartService->increment();
    }

    public function decrement($id)
    {
        $this->cartService->decrement();
    }
}
