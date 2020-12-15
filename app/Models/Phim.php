<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phim extends Model
{
    use HasFactory;

    protected $guarded=[];
    
    public function danhGia(){
    	return $this->hasMany('App\Models\DanhGia','phim_id','id');
    }
    public function doTuoi()
    {
        return $this->belongsTo('App\Models\DoTuoi','dotuoi_id','id');
    }
    public function theLoaiPhim(){
    	return $this->hasMany('App\Models\TheLoaiPhim','phim_id','id');
    }
    public function user(){
    	return $this->belongsTo('App\Models\User','user_id','id');
    }
    //Tạo url SEO
    // public function path()
    // {
    //     return url("/movie/{$this->id}-" . Str::slug($this->ten_chinh));
    // }
}
