<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function subcategory()
    {
        return $this->hasMany('App\Models\Subcategory', 'parent_id')->with('subchildcategory');
    }

    public function subchildcategory()
    {
        return $this->hasMany('App\Models\Subchildcategory','parent_id')->with('sublowerchild');
        //return $this->hasMany('App\Models\Subchildcategory', 'parent_id')->with('subcategory');
    }

    public function sublowerchild()
    {
        return $this->hasManyThrough('App\Models\Sublowerchildcategory','App\Models\Subchildcategory','parent_id','parent_id','id','id');

    }
}
