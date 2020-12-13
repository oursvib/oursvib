<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subamenity extends Model
{
    use HasFactory;
    protected $table='amenities';
    public function amenity(){
        return $this->belongsTo('App\Models\Amenity','id');
    }

}
