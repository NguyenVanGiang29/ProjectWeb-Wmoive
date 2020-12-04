<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    use HasFactory;

    protected $guarded=[];
    
    public function baiDang(){
    	return $this->belongsTo('App\Models\BaiDang','baidang_id','id');
    }
    public function user(){
    	return $this->belongsTo('App\Models\User','user_id','id');
    }
}
