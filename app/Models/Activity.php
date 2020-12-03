<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table='activity';

    public function subactivity(){
        return $this->hasMany('App\Models\Activity','parent_id','id')->with('subactivityitem');
    }

    public function subactivityitem(){
        return $this->hasMany('App\Models\Activity','parent_id','id');
    }
}
