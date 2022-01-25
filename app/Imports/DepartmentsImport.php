<?php

namespace App\Imports;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class DepartmentsImport implements ToModel, WithHeadingRow
{
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $validator = Validator::make($row, [
            'deparment_name'=>'unique:departments,name',
        ]);

        if ($validator->fails()) {
            return null;
        }
        
        
        return new Department([
            'name' => $row['deparment_name']
        ]);
    }
}
