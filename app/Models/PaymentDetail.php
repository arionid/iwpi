<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $table = 'payment_detail';

    protected $fillable = [
        'pendaftaran_id',
        'order_id',
        'payment_link_id',
        'expired_at',
        'status',
    ];

    public function profile()
    {
        return  $this->hasOne(PendaftaranAnggota::class, 'id', 'pendaftaran_id');
    }

    public function anggota()
    {
        return  $this->hasOne(AnggotaIWPI::class, 'id', 'pendaftaran_id');
    }
}
