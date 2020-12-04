<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoiDangKy extends Model
{
    use HasFactory;

    protected $table = 'goi_dang_kys';

    protected $guarded=[];
    
    public function user(){
    	return $this->hasMany('App\User','goidangky_id','id');
    }

}
