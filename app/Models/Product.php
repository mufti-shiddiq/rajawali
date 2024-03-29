<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'code', 'product_name', 'category', 'category_id', 'unit', 'unit_id', 'stock', 'sold', 'buy_price', 'sell_price'
    ];
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function stockIn()
    {
        return $this->hasMany(StockIn::class);
    }

    public function stockOut()
    {
        return $this->hasMany(StockOut::class);
    }
}
