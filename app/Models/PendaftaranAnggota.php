<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranAnggota extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_anggota';

    protected $fillable = [
        'email',
        'nik',
        'npwp',
        'fullname',
        'city_born',
        'born',
        'province_id',
        'address',
        'phone',
        'gender',
        'perkawinan',
        'file_ktp',
        'file_npwp',
        'user_agent',
        'ip_client_register',
        'status',
        'jabatan',
        'date_active',
    ];

    public function detail()
    {
        return  $this->hasOne(AnggotaIWPI::class, 'pendaftaran_id', 'id');
    }

    public function payment_detail()
    {
        return  $this->hasOne(PaymentDetail::class, 'pendaftaran_id', 'id');
    }
}
