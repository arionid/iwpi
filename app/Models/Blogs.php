<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\GenerateSlugTrait;

class Blogs extends Model
{
    use HasFactory, SoftDeletes, GenerateSlugTrait;

    protected $table = 'blog';
    const PATH = 'blog';
    protected $appends = ['next', 'previous'];

    protected $fillable = [
        'slug',
        'title',
        'excerpt',
        'content',
        'featured_img',
        'status',
        'type',
        'meta_title',
        'meta_description',
        'meta_image',
        'tag',
        'categories',
        'published_at',
    ];

    public function category() {
        return $this->hasOne(Categories::class, 'id', 'categories_id');
    }

    public function author()
    {
        return  $this->hasOne(User::class, 'id', 'author_id');
    }

    public function getNextAttribute()
    {
        return $this->where('id', '>', $this->id)->orderBy('id','asc')->first();
    }

    public function getPreviousAttribute()
    {
        return $this->where('id', '<', $this->id)->orderBy('id','asc')->first();
    }

}
