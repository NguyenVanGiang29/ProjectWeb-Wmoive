<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function quyen()
    {
        return $this->belongsTo('App\Models\Quyen','quyen_id','id');
    }
    public function goiDangKy()
    {
        return $this->belongsTo('App\Models\GoiDangKy','goidangky_id','id');
    }
    public function baiDang(){
    	return $this->hasMany('App\Models\BaiDang','user_id','id');
    }
    public function danhGia(){
    	return $this->hasMany('App\Models\DanhGia','user_id','id');
    }
    public function binhLuan(){
    	return $this->hasMany('App\Models\BinhLuan','user_id','id');
    }
    public function phim(){
    	return $this->hasMany('App\Models\Phim','user_id','id');
    }
    public function thich(){
    	return $this->hasMany('App\Models\Thich','user_id','id');
    }
}
