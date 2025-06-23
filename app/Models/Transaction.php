<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'total_price', 
        'cash_received', 
        'change_returned'
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
