<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;

    public function recipe()
    {
        return $this->belongsToMany(recipes::class,'recipe_categories','category_id','recipe_id');
    }
}
