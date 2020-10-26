<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sublowerchildcategory extends Model
{
    use HasFactory;

    public function subchildcategory(){
        return $this->belongsTo('App\Models\Subchildcategory','parent_id');
    }
}
