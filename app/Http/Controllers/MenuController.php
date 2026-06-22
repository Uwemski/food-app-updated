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
        $groupedProducts = Category::with(['product' => function($q) use ($request) {
                            if ($request->sort === 'price_asc') {
                                $q->orderBy('price');
                            }
                        }])->get();

        // Flat paginated view (when filtering by category or search)
        $products = Product::with('category')
            ->when($request->category, fn($q) => $q->whereHas('category', fn($q) => $q->where('slug', $request->category)))
            ->when($request->search,   fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->paginate(12);

        return view('menu', compact('categories', 'totalProducts', 'groupedProducts', 'products', 'cart', 'count'));
    }
}
