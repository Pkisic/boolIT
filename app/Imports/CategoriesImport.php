<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Facades\Validator;

class CategoriesImport implements ToModel, WithHeadingRow
{
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        $validator = Validator::make($row, [
            'category_name'=>'unique:categories,name',
        ]);

        if ($validator->fails()) {
            return null;
        }
        
        
        return new Category([
            'name' => $row['category_name']
        ]);
    }

}
