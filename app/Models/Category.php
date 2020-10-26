<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function Subcategory()
    {
        return $this->hasMany('App\Models\Subcategory', 'parent_id', );
    }
}