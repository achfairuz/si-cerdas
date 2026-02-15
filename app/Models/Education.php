<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $table = 'education';

    protected $fillable = [
        'title',
        'description',
        'imageUrl',
        'link',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}