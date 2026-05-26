<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    public function index()
    {
        return view('admin.create_category');
    }

    //method to store new category
    public function store(Request $request)
    {
        // dd('holiness must ve my lifestyle');
        //request validation
            $data = $request->validate([
                'name' => 'required|min:3'
            ]);

            $data['name'] = strip_tags($data['name']);
            $slug = Str::slug($data['name']);

            $count = Category::where('slug',"$slug")
                        ->orWhere('slug', 'like', '%{slug}%')
                        ->count();

            if($count > 0){
                $slug = $slug . '-' . ($count + 1);
            };

            $c = Category::create([
                'name' => $data['name'],
                'slug' => $slug
            ]);#

            if($c){
                return redirect()->back()->with('success', 'Category created successfully');
            }else{
                return redirect()->back()->with('error', 'Error encountered, please try again');
            }
    }

    //method to update
    public function update()
    {

    }

    //method to view all
    public function show()
    {
        $categories = Category::all();//very bad,practice using eager loading

        // dd($category);
        return view('admin.category', compact('categories'));
    }
}
