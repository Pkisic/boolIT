<?php

namespace App\Imports;

use App\Models\Manufacturers;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;


class ManufacturersImport implements ToModel, WithHeadingRow
{
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $validator = Validator::make($row, [
            'manufacturer_name'=>'unique:manufacturers,name',
        ]);

        if ($validator->fails() || empty($row)) {
            return null;
        }
        
        return new Manufacturers([
            'name' => $row['manufacturer_name']
        ]);
    }
}
