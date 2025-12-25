<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
class Product extends Model
{
    //
    use UUID;

    protected $fillable=[
        'stock'
    ];

    protected $casts=[
        'price'=>'decimal:2'
    ];

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class);
    }

    public function productImages(){
        return $this->hasMany(ProductImage::class);
    }
   
     public function transactionDetails(){
        return $this->hasMany(TransactionDetails::class);
    }
      public function productReviews(){
        return $this->hasMany(ProductReview::class);
    }
}
