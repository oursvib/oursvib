<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table='country';
    protected $primaryKey = 'countryId';
    protected $fillable = ['code','name'];

    public function listing(){
        return $this->belongsTo('App\Models\Listing','country','countryId');
    }

}
