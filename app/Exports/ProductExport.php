<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\Category;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;



class ProductExport implements FromQuery
{
    use Exportable;
    
    public function __construct(int $category) 
    {
        $this->category = $category;
    }

    public function query()
    {
        return Product::query()->where('category_id', $this->category);
    }

}