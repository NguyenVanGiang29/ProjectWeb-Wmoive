<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoTuoi extends Model
{
    use HasFactory;

    protected $guarded=[];
    
    public function phim(){
    	return $this->hasMany('App\Phim','dotuoi_id','id');
    }
}
