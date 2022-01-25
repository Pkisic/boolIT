<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    public function allCategories(Request $request)
    {
        $allCategories = Category::All();
        
        return response()->json([
            'allCategories' => $allCategories,
        ]);
    }
    
    public function update(Request $request, Category $category)
    {
        
        $validator = Validator::make($request->input(), [
            'id'=>['required','exists:categories,id'],
            'name' =>['required','string','max:140',Rule::unique('categories')->ignore($category->id)],
        ]);

        if($validator->fails()){
            return response()->json([
                'system_error' => 'Wrong category parameters!'
            ],400);
        }
        
        $validated = $validator->validated();
        $category->name = $validated['name'];
        $category->save();
        return response()->json([
            "system_message" => "Successfully updated Category!",
            "category" => $category,
        ]);
        
    }
}
