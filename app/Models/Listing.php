<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = ['vendor_id', 'root_category', 'parent_category', 'child_category','niche_category','listing_type','status','title','description','about','team','address','unique_services','stragetic_partner','guest_experience','news_highlight','green_innitiative','star_rating','csr_partner','food_partner','capacity_by','city','state','country','zipcode','video','supporting_document'];

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

    public function listingnearby(){
        return $this->hasMany('App\Models\Listingnearby','listing_id','id');
    }

    public function listingprice(){
        return $this->hasOne('App\Models\Listingprice','listing_id','id');
    }

    public function listingcapacity(){
        return $this->hasOne('App\Models\Listingcapacity','listing_id','id');
    }

    public function listingactivity(){
        return $this->hasMany('App\Models\Listingactivity','listing_id','id');
    }

    public function listingamenity(){
        return $this->hasMany('App\Models\Listingamenity','listing_id','id');
    }

    public function listingadditional(){
        return $this->hasMany('App\Models\Listingadditional','listing_id','id');
    }

    public function listingimages(){
        return $this->hasMany('App\Models\Listingimage','listing_id','id');
    }
}
