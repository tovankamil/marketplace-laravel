<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
class StoreBalanceHistory extends Model
{
    //

    use UUID;
     
    protected $fillable=[
        'store_balance_id',
        'type',
        'reference_id',
        'amount',
        'remarks',
    ];

    public function storeBalance(){
        return $this->belongsTo(StoreBalance::class);
    }

}
