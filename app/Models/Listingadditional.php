<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listingadditional extends Model
{
    use HasFactory;
    protected $table='listing_additional';
    protected $fillable=['listing_id','additional_id','type','amount'];
}
