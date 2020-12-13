<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listingamenity extends Model
{
    use HasFactory;
    protected $table='listing_amenity';
    protected $fillable=['listing_id','amenity_id'];

    public function listing(){
        return $this->belongsTo('App\Models\Listing','id','listing_id');
    }
}
