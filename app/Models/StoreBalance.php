<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
class StoreBalance extends Model
{
    //
    use UUID;

    protected $fillable=[
        'store_id',
        'balance'
    ];

    protected $casts=[
        'balance'=>'decimal:2'
    ];
    // store balance is  owner by one store

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function storeBalanceHistories(){
        return $this->hasMany(StoreBalanceHistory::class);
    }

    public function withDrawls(){
        return $this->hasMany(withDrawl::class);
    }
}
