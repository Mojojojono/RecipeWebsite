<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingredients extends Model
{
    use HasFactory;

   
    public function recipe(): BelongsToMany
    {
        return $this->belongsToMany(recipes::class, 'recipe_ingredients');
    }
}
