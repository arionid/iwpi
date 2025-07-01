<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuDownload extends Model
{
    use HasFactory;

    protected $table = 'menu_downloads';

    protected $fillable = [
        'nama',
        'file',
        'jenis',
        'keterangan',
        'status',
    ];
}
