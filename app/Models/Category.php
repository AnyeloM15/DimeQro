<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'image', 'description','active'];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
