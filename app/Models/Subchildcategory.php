<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subchildcategory extends Model
{
    use HasFactory;
    protected $fillable = ['parent_id', 'name'];

    public function sublowerchild(){
        return $this->hasMany('\App\Models\Sublowerchildcategory','parent_id');
    }

    public function Subcategory(){
        return $this->belongsTo('\App\Models\Subcategory');
    }
    public function category(){
        return $this->belongsTo('\App\Model\Category')->with('App\Models\Subcategory');
    }

    public function sublowerchildcategory()
    {
        return $this->hasManyThrough('App\Models\Subcategory','App\Models\Subchildcategory','parent_id','parent_id','id','id')->with('sublowerchild');
      //  return $this->hasMany('App\Models\Sublowerchildcategory','parent_id','id');
    }
}
