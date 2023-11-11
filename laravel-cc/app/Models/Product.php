<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
