<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\GenerateSlugTrait;

class Categories extends Model
{
    use HasFactory, GenerateSlugTrait;


    protected $table = 'categories';
    const PATH = 'categories';

    protected $fillable = [
        'slug',
        'name',
        'slug',
        'icon'
    ];
}
