<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function parentCategory()
    {
        return $this->belongsTo(self::class, 'parent_category_id');
    }

    public function childCategories()
    {
        return $this->hasMany(self::class, 'parent_category_id');
    }
}
