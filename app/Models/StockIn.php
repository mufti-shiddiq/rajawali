<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'stock_ins';
    protected $primaryKey = 'id';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
