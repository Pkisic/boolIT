<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function allProducts()
    {
        $allProducts = Product::all();
        
        return response()->json([
            "allProducts" => $allProducts,
        ]);
    }
}
