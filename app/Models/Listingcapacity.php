<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listingcapacity extends Model
{
    use HasFactory;
    protected $table='listing_capacity';
    protected $fillable=['listing_id','area_by','min_pax','max_pax','seating_pax','standing_pax','cooktail_pax','classroom_pax','theatre_pax','banquet_pax','conference_pax','ushape_pax'];

}
