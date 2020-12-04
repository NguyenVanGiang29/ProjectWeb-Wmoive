<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    use HasFactory;

    protected $guarded=[];
    
    public function theLoaiPhim(){
    	return $this->hasMany('App\TheLoaiPhim','theloai_id','id');
    }
}
