<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $table = 'recipes';

    protected $fillable = [
        'title',
        'imageUrl',
        'portion',
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
}
