<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listingprice extends Model
{
    use HasFactory;
    protected $table='listing_price';
    protected $fillable=['listing_id','billing_type','peak_start','peak_end','normal_price','peak_price'];

    public function listing(){
        return $this->belongsTo('App\Models\Listing','id','listing_id');
    }
}
