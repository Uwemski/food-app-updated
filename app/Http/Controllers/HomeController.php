<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Services\CartService;

class HomeController extends Controller
{
    //
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        $count = $this->cartService->count();
        $categories = Category::withCount('product')->get();
        $footerCategories = Category::limit(7)->get();
        $featuredProducts = Product::with('category')->where('is_available', true)->paginate(8);

        return view('home', compact('cart', 'count', 'categories', 'footerCategories', 'featuredProducts'));
    }

    public function menu(Request $request)
    {
        $cart = $this->cartService->getCart();
        $categories = Category::withCount('product')->get();
        $footerCategories = Category::limit(7)->get();
        $featuredProducts = Product::with('category')->where('is_available', true)->paginate(8);
        $totalProducts = Product::count();
        $totalCategories = Category::count();
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

            // dd($groupedProducts);
        return view('menu', compact('cart', 'categories', 'footerCategories', 'featuredProducts', 'totalProducts', 'totalCategories', 'groupedProducts', 'products'));
    }
}
