<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table='cities';
    protected $primaryKey = 'cityId';
    protected $fillable = ['countryId','regionId','name','state_abr'];

    public function listing(){
        return $this->belongsTo('App\Models\Listing','city','cityId');
    }
}
