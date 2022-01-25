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
        
        //validates existence of category
        $validator = Validator::make($request->all(), [
            'id'=>['nullable','exists:categories,id','in:' . $category->id],
            'name' =>['required','string','max:140',Rule::unique('categories')->ignore($category->id)],
        ]);
        
        //if failed returning response
        if($validator->fails()){
            return response()->json([
                'system_error' => 'Wrong category parameters!'
            ],400);
        }
        
        //validated input
        $validated = $validator->validated();
        
        //updating and saving category
        $category->name = $validated['name'];
        $category->save();
        
        //returning response
        return response()->json([
            "system_message" => "Successfully updated Category!",
            "category" => $category,
        ]);
        
    }
    
    public function delete(Request $request, Category $category)
    {
        $category->delete();
        
        return response()->json([
            'system_message' => $category->name . ' has been deleted!',
        ]);
    }
}
