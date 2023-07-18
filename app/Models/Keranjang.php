<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function joinBarang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }

    public function joinVoucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id', 'id');
    }
}
