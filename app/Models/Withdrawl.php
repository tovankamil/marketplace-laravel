<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
class Withdrawl extends Model
{
    //
    use UUID;

    protected $fiilable=[
        'store_balance_id',
        'amount',
        'bank_account_name',
        'bank_account_number',
        'bank_name',
        'status'
    ];

    public function storeBalance(){
        return $this->belongsTo(StoreBallance::class);
    }
}
