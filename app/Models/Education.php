<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Education extends Model
{
    use HasFactory;
    protected $table = 'education';

    protected $fillable = [
        'title',
        'description',
        'imageUrl',
        'link',
        'slug',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($education) {
            $education->slug = static::generateUniqueSlug($education->title);
        });

        static::updating(function ($education) {
            if ($education->isDirty('title')) {
                $education->slug = static::generateUniqueSlug($education->title);
            }
        });
    }

    private static function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = static::where('slug', 'like', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }
}