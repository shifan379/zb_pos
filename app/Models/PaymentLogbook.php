<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLogbook extends Model
{
    use HasFactory;

    protected $table = 'payment_logbooks';
    protected $fillable = [
        'user_id',
        'name',   // 'payin' for income, 'payout' for expense
        'amount',
        'reason',
        'date',
    ];
}
