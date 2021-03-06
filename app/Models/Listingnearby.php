<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listingnearby extends Model
{
    use HasFactory;
    protected $table='listing_nearby';
    protected $fillable=['listing_id','nearby','distance'];

    public function listing(){
        return $this->belongsTo('App\Models\Listing','id','listing_id');
    }
}
