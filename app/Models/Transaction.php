<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id_transaction';
    protected $fillable = ['product_id','quantity','total_price'];
    public $timestamps = false;

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id_product');
    }
}
