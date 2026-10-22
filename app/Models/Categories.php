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

    protected static function booted(): void
    {
        // Nama kategori ikut tersimpan di cache blog
        $flush = fn (Categories $category) => Blogs::forgetCache(
            Blogs::withTrashed()->where('categories_id', $category->id)->pluck('slug')->all()
        );

        static::saved($flush);
        static::deleted($flush);
    }
}
