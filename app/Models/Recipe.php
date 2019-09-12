<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public $fillable = [
        'title',
        'description',
        'user_id'
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class,'ingredient_recipes')
            ->withPivot('amount');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
