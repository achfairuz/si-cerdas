<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Recipe extends Model
{
    use HasFactory;
    protected $table = 'recipes';

    protected $fillable = [
        'title',
        'imageUrl',
        'portion',
        'slug',
        'duration',
        'description',
        'category_id'
    ];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class)
            ->orderBy('order');
    }

    public function steps()
    {
        return $this->hasMany(Step::class)
            ->orderBy('order');
    }

    public function nutritions()
    {
        return $this->hasMany(Nutrition::class);
    }

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