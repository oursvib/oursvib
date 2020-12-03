<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listingactivity extends Model
{
    use HasFactory;
    protected $table='listing_amenity';
    protected $fillable=['listing_id','activity_id'];
}
