<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    use HasFactory;

    protected $fillable = [
        'custumer_name',
        'total_amount',
        'voucher_code',
        'voucher_expiry_date',
    ];
}
