<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listingimage extends Model
{
    use HasFactory;
    protected $table='listing_image';
    protected $fillable=['listing_id','listing_images'];

    public function listing(){
        return $this->belongsTo('App\Models\Listing','id','listing_id');
    }
}
