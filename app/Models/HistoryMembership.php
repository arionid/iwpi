<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryMembership extends Model
{
    use HasFactory;

    protected $table = 'history_membership';

    protected $fillable = [
        'anggota_id',
        'order_id',
        'tgl_mulai',
        'tgl_akhir',
        'bukti_bayar',
        'status',
    ];

    public function anggota()
    {
        return  $this->hasOne(AnggotaIWPI::class, 'pendaftaran_id', 'anggota_id');
    }
}
