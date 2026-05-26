<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\CreateProductRequest;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //
    public function index()
    {
        $category = Category::all();
        return view('admin.create_product', compact('category'));
    }

    public function guestIndex(){
        $product = Product::with('category')->latest()->paginate(15);

        return view('product.index' ,compact('product'));
    }

    public function store(CreateProductRequest $request)
    {
        $data = $request->validated();

        $slug = Str::slug($data['name']);
        $count = Product::where('slug', "$slug")
                ->orWhere('slug', 'LIKE', "{$slug}-%")
                ->count();
        //add it
        if($count > 0){
            $slug = $slug . '-' . ($count + 1);
        }
        $data['slug'] = $slug;
        //dd($data);
        $imagePath = null;

        //try catch
        try{
            if($request->hasFile('image')) {
                $path = $request->file('image')->store('uploads', 'products');
                $data['image'] = $path;
            }

            $product = Product::create($data);
            return redirect()->back()->with('success', 'product created successfully');
        } catch(\Exception $e) {
            // Logg
            \Log::error('Product creation failed: '. $e->getMessage());
            return redirect()->back()->with('error', 'Error encountered, try again');
        }
    }

    public function show(){
        $products = Product::all();

        return view('admin.products', compact('products'));
    }

    //a method to updateAvailability
    public function updateAvailability(Product $product, Request $request)
    {
        $data = $request->validate([
            'is_available' => 'required|boolean'
        ]);

        $product->update($data);

        return redirect()->back()->with('success', 'Availability updated successfully');
    }

    //a method to update quantity
    public function updateQuantity(Product $product, Request $request)
    {
        $data = $request->validate([
            'quantity' => 'required'
        ]);

        $product->update($data);

        return redirect()->back()->with('success', 'Quantity updated successfully');
    }

    //a method to remove product
    public function remove(Product $product)
    {
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    public function edit(Product $product)
    {
        $category = Category::all();
        $product = Product::findOrFail($product->id);

        return view('admin.edit_product', compact('product','category') );
    }
}
