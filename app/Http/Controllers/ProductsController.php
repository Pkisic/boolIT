<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductsController extends Controller
{
    public function allProducts()
    {
        $allProducts = Product::all();
        
        return response()->json([
            "allProducts" => $allProducts,
        ]);
    }
    
    public function categoryProducts(Request $request, Category $category)
    {
        $allProducts = Product::whereBelongsTo($category,'productCategory')->get();
        
        return response()->json([
           "Products from category " . $category->name => $allProducts, 
        ]);
    }
}
