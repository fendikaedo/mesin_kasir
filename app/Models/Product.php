<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'id_product';
    protected $fillable = ['product_code','product_name','product_price','stock','category_product_id'];
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_product_id');
    }
}
