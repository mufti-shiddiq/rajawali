<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Reportable\Traits\Reportable;

class Transaction extends Model
{
    use HasFactory;
    use \Reportable\Traits\Reportable;

    protected $guarded = [];

    // protected $dateFormat = 'd-m-Y H:i:s';

    public function transaction_detail()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
