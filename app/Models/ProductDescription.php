<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_descriptions';
    
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
    protected $fillable = ['product_number','description_id'];
    
    //Relations
    public function products(){
        return $this->belongsToMany(Product::class,
                'product_descriptions',
                'description_id',
                'product_number');
    }
    
}
