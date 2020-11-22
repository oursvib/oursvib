<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = ['vendor_id', 'root_category', 'parent_category', 'child_category','niche_category','listing_type','status','title','description','about','team','address','city','state','country','zipcode','video'];

}
