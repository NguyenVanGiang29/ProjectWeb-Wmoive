<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheLoaiPhim extends Model
{
    use HasFactory;

    protected $guarded=[];
    
    public function phim(){
    	return $this->belongsTo('App\Phim','phim_id','id');
    }
    public function theLoai(){
    	return $this->belongsTo('App\TheLoai','theloai_id','id');
    }
}
