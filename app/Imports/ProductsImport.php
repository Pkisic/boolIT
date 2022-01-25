<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Department;
use App\Models\Manufacturers;
use App\Models\Product;

class ProductsImport implements ToModel,WithHeadingRow
{
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $validator = Validator::make($row, [
            'product_number'=>'unique:products,product_number',
        ]);

        if ($validator->fails() || empty($row)) {
            return null;
        }
        
        $category = Category::where('name', '=', $row['category_name'])->first();
        $department = Department::where('name', '=', $row['deparment_name'])->first();
        $manufacturer = Manufacturers::where('name', '=', $row['manufacturer_name'])->first();
        
        return new Product([
            'product_number' => $row['product_number'],
            'upc' => $row['upc'],
            'sku' => $row['sku'],
            'regular_price' => $row['regular_price'],
            'sale_price' => $row['sale_price'],
            'category_id' => $category->id,
            'department_id' => $department->id,
            'manufacturer_id' => $manufacturer->id,
        ]);
        
    }
}
