<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';
    
    /**
     * Timestamps not included.
     *
     */
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_number',
        'upc','sku','regular_price',
        'sale_price','description',
        'category_id','department_id',
        'manufacturer_id'
    ];
    
    //Relations
    public function productCategory()
    {
        return $this->belongsTo(Category::class,
                'category_id',
                'id');
    }
    
    public function departments()
    {
        return $this->belongsTo(Department::class,
                'department_id',
                'id');
    }
    
    public function manufacturers()
    {
        return $this->belongsTo(Manufacturers::class,
                'manufacturer_id',
                'id');
    }
    
    public function descriptions()
    {
        return $this->belongsToMany(
            Description::class,
                'product_descriptions',
                'product_number',
                'description_id'
                );
    }
    
}
