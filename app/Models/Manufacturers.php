<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturers extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'manufacturers';
    
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
    protected $fillable = ['name'];
    
    
    //Relations
    public function products()
    {
        return $this->hasMany(
                Product::class,
                'manufacturer_id',
                'id');
    }
}
