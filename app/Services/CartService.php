<?php

namespace App\Services;
use App\Models\Product;

class CartService
{

    public function add(Product $product, int $quantity = 1): void
    {
        $id = $product->id;

        $cart= $this->getCart();

        if(isset($cart[$id])){
            //product already in cart, increase quantity
            $cart[$id]['quantity'] += $quantity;
        }else{
            // New product, add to cart
            $cart[$id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'image' => $product->image
            ];
        }

        $this->saveCart($cart);
    }

    public function update(int $productId, int $quantity)
    {
        $cart = $this->getCart();

        if(isset($cart[$productId])){
            if($quantity < 0){
                $this->remove($productId);
                return;
            }
        }
        $cart[$productId]['quantity'] = $quantity;
        
        $this->saveCart('cart', $cart);
    }

    public function remove($id)
    {
        $cart = $this->getCart();

        if(isset($cart[$id])){
            unset($cart[$id]);
            //put back in session
            $this->saveCart($cart);
        }
    }

    public function clear()
    {
        session()->forget('cart');
    }
    /*
        Get Cart as array
    */
    
    //getter method
    public function getCart(): array
    {
        return session()->get('cart', []);
    }

    /*
        *save CArt contents
    */
    //setter method
    public function saveCart(array $cart): void
    {
       session()->put('cart', $cart);
    }

    public function getCartCollection() {
        //helper method to get cart which is an array as collection which is easier to manipulate. Lowkey super power of laravel

        return collect($this->getCart());
    }

    public function subtotal()
    {
        return $this->getCartCollection()
            ->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    public function count(): int
    {
        return $this->getCartCollection()->sum('quantity');
    }

    public function deliveryFee(){
       return 1500; //flat rate for now
    }

    /**
     * Calculate grand total (subtotal + delivery)
     * 
     * @return float
     */ 
    public function total()
    {
        return $this->subtotal() + $this->deliveryFee();
    }

    /**
     * Check if cart is empty
     * 
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->getCart());
    }

    /**
     * Increment product quantity by 1
     * 
     * @param int $productId
     * @return void
     */
    public function increment(int $productId): void
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
            $this->saveCart($cart);
        }
    }

    /**
     * Decrement product quantity by 1
     * 
     * @param int $productId
     * @return void
     */
    public function decrement(int $productId): void
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            if ($cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
                $this->saveCart($cart);
            } else {
                // If quantity would become 0, remove item instead
                $this->remove($productId);
            }
        }
    }
}