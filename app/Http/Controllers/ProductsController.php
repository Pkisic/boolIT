<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Description;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

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
    
    public function update(Request $request, Product $product)
    {
        
        $validator = Validator::make($request->all(), [
            'product_number' => ['sometimes','required',Rule::unique('products')->ignore($product),'string','max:255'],
            'upc' => ['sometimes','required','string','max:13',Rule::unique('products')->ignore($product)],
            'sku' => ['sometimes','required','string','max:13',Rule::unique('products')->ignore($product)],
            'regular_price' => ['sometimes','required','numeric','min:0.01'],
            'sale_price' => ['sometimes','required','numeric','min:0.01'],
            'category_id' => ['sometimes','required', 'exists:categories,id'],
            'department_id' => ['sometimes','required', 'exists:departments,id'],
            'manufacturer_id' => ['sometimes','required', 'exists:manufacturers,id'],
            'descriptions' => ['sometimes','array']
        ]);
        
        //if failed returning response
        if($validator->fails()){
            return response()->json([
                'system_error' => 'Wrong Product parameters!',
                'errors' => $validator->errors(),
            ],400);
        }
        
        //validated input
        $validated = $validator->validated();
        
        //updating and saving category
        $product->fill($validated);
        
        if(isset($validated['descriptions']) && !empty($validated['descriptions'])){
            foreach($validated['descriptions'] as $description){
                
                $dbDescription = Description::where('description','LIKE',$description)->first();
                
                if(!empty($dbDescription)){
                    $product->descriptions()->sync($dbDescription->id);
                }else{
                    $newDescription = new Description();
                    $newDescription->description = $description;
                    $newDescription->save();
                }
            }
            $product->descriptions()->sync($dbDescription ?? $newDescription);
        }
        
        $product->save();
        
        //returning response
        return response()->json([
            "system_message" => "Successfully updated Product!",
            "product" => $product,
        ]);
    }
    
    public function delete(Request $request, Product $product)
    {
        
        $product->delete();
        
        return response()->json([
            'system_message' => $product->product_number . ' has been deleted!',
        ]);
        
    }
}
