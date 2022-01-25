<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function allCategories(Request $request)
    {
        $allCategories = Category::All();
        
        return response()->json([
            'allCategories' => $allCategories,
        ]);
    }
}
