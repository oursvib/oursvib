<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['vendor_id', 'listing_id', 'user_id', 'blockings','start_date','end_date','booking_ref_no','booking_progress','amountpaid'];

    public function vendor(){
        return $this->belongsTo('App\Models\User','vendor_id','id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function listing(){
        return $this->belongsTo('App\Models\Listing','listing_id','id');
    }

}
