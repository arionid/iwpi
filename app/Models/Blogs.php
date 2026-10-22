<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

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

    public const CACHE_RECENT = 'recent-blog';

    public static function detailCacheKey(string $slug): string
    {
        return 'detail-new-' . $slug;
    }

    /**
     * Hapus cache frontend (daftar terbaru + detail per slug).
     */
    public static function forgetCache(array $slugs = []): void
    {
        Cache::forget(self::CACHE_RECENT);

        foreach (array_unique(array_filter($slugs)) as $slug) {
            Cache::forget(self::detailCacheKey($slug));
        }
    }

    protected static function booted(): void
    {
        // Slug lama ikut dihapus karena bisa berubah saat judul diedit
        $flush = fn (Blogs $blog) => self::forgetCache([$blog->slug, $blog->getOriginal('slug')]);

        static::saved($flush);
        static::deleted($flush);
        static::restored($flush);
        static::forceDeleted($flush);
    }

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
