<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'descriptions';
    
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
    protected $fillable = ['description'];
    
    //Relations
    public function products(){
        return $this->belongsToMany(Product::class,
                'product_descriptions',
                'description_id',
                'product_number');
    }
}
