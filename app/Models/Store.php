<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Builder;
class Store extends Model
{
    //
    use UUID , HasFactory;

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
        return $this->hasOne(StoreBalance::class);
    }
     public function transactions(){
        return $this->hasMany(Transaction::class);
    }

      public function scopeSearch(Builder $query, string $search)
    {
        // Cleaned up syntax for readability
        return $query->where('name', 'like', '%'.$search.'%')
            ->orWhere('phone', 'like', '%'.$search.'%');
    }
}
