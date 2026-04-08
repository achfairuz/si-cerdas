<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'imageUrl',
        'type',
    ];

    public function recipes()
    {
        return $this->hasMany(Recipe::class)->orderBy('created_at', 'asc');
    }
    public function educations()
    {
        return $this->hasMany(Education::class)->orderBy('created_at', 'asc');
    }
}
