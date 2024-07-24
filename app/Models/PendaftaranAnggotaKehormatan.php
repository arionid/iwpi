<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PendaftaranAnggotaKehormatan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pendaftaran_anggota_kehormatan';

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
        'file_bukti_pekerjaan',
        'no_kta_kehormatan',
        'bidang_pekerjaan',
        'jabatan',
        'tgl_mulai',
        'tgl_akhir',
    ];
}
