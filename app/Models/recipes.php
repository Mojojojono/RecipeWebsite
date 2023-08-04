<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recipes extends Model
{
    use HasFactory;
    protected $table = 'recipes';
    protected $fillable = [
        'title',
        'Description',
        'Instructions',
        'Prep_time',
        'cook_time',
        'total_time',
        'servings',
        'cover',
    ];
   
    /**
     * The roles that belong to the recipes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     
     */

     public function users()
     {
         return $this->belongsToMany(User::class, 'user_recipe','recipe_id','user_id');
     }
    public function ingredients()
    {
        return $this->belongsToMany(ingredients::class, 'recipe_ingredients','recipe_id', 'ingredients_id')->withPivot(['quantity']);
    }

    public function category()
    {
        return $this->belongsToMany(categories::class,'recipe_categories','recipe_id', 'category_id');
    }

    public function photos(): BelongsToMany
    {
        return $this->belongsToMany(photos::class);
    }


    public function instructions()
    {
        return $this->hasMany(instructions::class);
    }
}
