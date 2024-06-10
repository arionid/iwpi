<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaIWPI extends Model
{
    use HasFactory;

    protected $table = 'anggota_iwpi';

    protected $fillable = [
        'pendaftaran_id',
        'nomor_anggota',
        'layanan',
        'layanan_nominal',
        'tgl_mulai',
        'tgl_akhir',
        'bukti_bayar',
        'tgl_bayar',
        'nama_pengirim',
        'keterangan',
        'status',
    ];

    public function profile()
    {
        return  $this->hasOne(PendaftaranAnggota::class, 'id', 'pendaftaran_id');
    }
}
