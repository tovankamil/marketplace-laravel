<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
class Store extends Model
{
    //
    use UUID;

    protected $fillable=[
        'user_id',
        'name',
        'logo',
        'about',
        'phone',
        'address_id',
        'city',
        'address',
        'postal_code',
        'is_verified'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function storeBallance(){
        return $this->hasOne(StoreBallance::class);
    }
     public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
