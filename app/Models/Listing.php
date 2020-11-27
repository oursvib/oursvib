<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = ['vendor_id', 'root_category', 'parent_category', 'child_category','niche_category','listing_type','status','title','description','about','team','address','city','state','country','zipcode','video'];

    public function rootCategory(){
       return $this->hasOne('App\Models\Category','id','root_category');
    }

    public function parentCategory(){
       return $this->hasOne('App\Models\Subcategory','id','parent_category');
    }
    public function childCategory(){
       return $this->hasOne('App\Models\Subchildcategory','id','child_category');
    }
    public function nicheCategory(){
       return $this->hasOne('App\Models\Sublowerchildcategory','id','niche_category');
    }
    public function user(){
        return $this->hasOne('App\Models\User','id','vendor_id');
    }
}
