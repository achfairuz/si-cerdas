<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nutrition extends Model
{
    use HasFactory;
    protected $table = 'nutrition';
    protected $fillable = ['recipe_id', 'key', 'label', 'value'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}