<?php

namespace App\Models;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use UUID;
    protected $fillable = [
        'transaction_id', //
        'product_id',     //
        'rating',         //
        'review',         //
    ];

    // Relasi ke Transaksi
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    // Relasi ke Produk
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
