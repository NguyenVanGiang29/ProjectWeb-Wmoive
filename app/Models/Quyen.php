<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quyen extends Model
{
    use HasFactory;

    protected $guarded=[];
    
    public function user(){
    	return $this->hasMany('App\User','quyen_id','id');
    }
}
