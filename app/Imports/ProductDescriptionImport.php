<?php

namespace App\Imports;

use App\Models\ProductDescription;
use App\Models\Description;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;


class ProductDescriptionImport implements ToModel,WithHeadingRow {

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row) {
        
        $validator = Validator::make($row, [
            'product_number'=>'unique:product_descriptions,product_number',
        ]);

        if ($validator->fails() || empty($row)) {
            return null;
        }
        
        $descriptions = explode(';', $row['description']);
        
        foreach ($descriptions as $value) {
            
            $description = Description::where('description', '=', $value)->first();
            
            if(isset($description->id) && !empty($description->id)){
                
                return new ProductDescription([
                    'product_number' => $row['product_number'],
                    'description_id' => $description->id,
                ]);
                
            }
        }
    }

}
