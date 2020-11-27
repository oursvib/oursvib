<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sublowerchildcategory extends Model
{
    use HasFactory;
    protected $fillable = ['parent_id', 'name'];

    public function listing(){
        return $this->belongsTo('App\Models\Listing','niche_category','id');
    }
}
