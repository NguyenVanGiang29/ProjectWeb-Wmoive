<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiDang extends Model
{
    use HasFactory;

    protected $guarded=[];
    
    public function loaiBaiDang(){
    	return $this->belongsTo('App\Models\LoaiBaiDang','loaibd_id','id');
    }
    public function user(){
    	return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function binhLuan(){
    	return $this->hasMany('App\Models\BinhLuan','baidang_id','id');
    }
    public function thich(){
    	return $this->hasMany('App\Models\Thich','baidang_id','id');
    }
    //Tạo url SEO
    public function url()
    {
        return url("/post/{$this->id}-{$this->tieu_de}");
    }
}
