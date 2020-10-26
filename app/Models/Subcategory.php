<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = ['parent_id', 'name'];

    public function category(){
        return $this->belongsTo('\App\Models\Category');
    }
    public function subchildcategory(){
        return $this->hasMany('\App\Models\Subchildcategory','parent_id');
    }

    public function sublowerchild(){
        return $this->hasManyThrough('\App\Models\Sublowerchildcategory','\App\Models\Subchildcategory','parent_id','parent_id','id','id')->with('subchildcategory');
    }
}
