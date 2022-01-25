<?php

namespace App\Imports;

use App\Models\Description;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;


class DescriptionsImport implements ToModel, WithHeadingRow {

    
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row) {
        
        $descriptions = explode(';', $row['description']);

        foreach ($descriptions as $value) {
            
            $validator = Validator::make([$value], [
                'unique:descriptions,description',
            ]);

            if ($validator->fails() || empty($value)) {
                
                return null;
            }
            
            return new Description([
                'description' => $value
            ]);
            
        }
        
    }

}
