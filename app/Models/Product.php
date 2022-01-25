<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $table = 'products';
    
    public $timestamps = false;
    
    protected $fillable = [
        'product_number',
        'upc','sku','regular_price',
        'sale_price','description',
        'category_id','department_id',
        'manufacturer_id'
    ];
    
}
