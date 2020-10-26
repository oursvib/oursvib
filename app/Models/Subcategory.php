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

}
