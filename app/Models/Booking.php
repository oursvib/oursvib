<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['vendor_id', 'listing_id', 'user_id', 'blockings','start_date','end_date','booking_ref_no'];
}
