<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//add relasi antar tabel
use App\Models\Category;
use App\Models\Product;


class HomeController extends Controller
{
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::take(6)->get();
        $products = Product::with(['product_galleries'])->take(12)->get();    
        
        
        return view('pages.home',[
            'categories' => $categories,
            'products' => $products
        ]);

    }

}
