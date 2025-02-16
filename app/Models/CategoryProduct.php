<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    protected $table = 'category_product';
    protected $primaryKey = 'id_category';
    protected $fillable = [
        'category_name',
    ];
    public $timestamps = false;
    public function products()
    {
        return $this->hasMany(Product::class, 'category_product_id');
    }
}
