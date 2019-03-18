<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['doc_number', 'quantity', 'product_id', 'user_id'];

    public function product() {
        return $this->belongsTo('\App\Product');
    }

    public function user() {
        return $this->belongsTo('\App\User');
    }

    public $timestamps = true;
}
