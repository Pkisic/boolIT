<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{
    use HasFactory;
    
    protected $table = 'product_descriptions';
    public $timestamps = false;
    protected $fillable = ['product_number','description_id'];
    
}
