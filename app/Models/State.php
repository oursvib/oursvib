<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table='region';
    protected $primaryKey = 'regionId';
    protected $fillable = ['countryId','name','state_abr'];

    public function listing(){
        return $this->belongsTo('App\Models\Listing','state','regionId');
    }
}
