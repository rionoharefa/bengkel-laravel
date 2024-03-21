<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//add relasi antar tabel
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::with(['product_galleries'])->paginate(32); 
        
        return view('pages.category', [
            'categories' => $categories,            
            'products' => $products
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detail(Request $request, $slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::with(['product_galleries'])->where('categories_id', $category->id)->paginate(32); 
        
        return view('pages.category', [
            'categories' => $categories,
            'category' => $category,
            'products' => $products
        ]);
    }




}
