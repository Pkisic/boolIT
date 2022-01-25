<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturers extends Model
{
    use HasFactory;
    
    protected $table = 'manufacturers';
    public $timestamps = false;
    
    protected $fillable = [
        'name'
        ];
}
