<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Services\CartService;

class MenuController extends Controller
{

    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    //
    public function index(Request $request)
    {
        $data=$request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $cart = $this->cartService->getCart();
        $count = $this->cartService->count();
        $categories = Category::withCount('product')->get();
        $totalProducts = Product::count();

        $groupedProducts= null;
        $products= null;

        $hasFilter = $request->has('category') || $request->has('search');
        if($hasFilter){
        // Flat paginated view (when filtering by category or search)

            // Flat filtered/searched view
            $products = Product::with('category')
                ->when($request->category, fn($q) => $q->whereHas('category', fn($q) => $q->where('slug', $request->category)))
                ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
                ->when($request->sort === 'price_asc', fn($q) => $q->orderBy('price'))
                ->when($request->sort === 'price_desc', fn($q) => $q->orderBy('price', 'desc'))
                ->paginate(12)
                ->withQueryString(); // keeps ?search=... in pagination links
        }else{    
        // Grouped browse view (no filters active)
            $groupedProducts = Category::with(['product' => function($q) use ($request) {
                            if ($request->sort === 'price_asc') {
                                $q->orderBy('price');
                            }
                        }])
                        ->whereHas('product')
                        ->get();
        }
               
        return view('menu', compact('categories', 'totalProducts', 'groupedProducts', 'products', 'cart', 'count'));
    }
}
