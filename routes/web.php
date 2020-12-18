<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuyenController;
use App\Http\Controllers\PhimAdminController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChiTietPhimController;
use App\Http\Controllers\ChiTietBaiDangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('home', [PageController::class, 'getHome'])->name('home');
Route::get('all-movies', [PageController::class, 'getAllPhim'])->name('all-movies');
Route::get('movie/{id}-{slug}', [ChiTietPhimController::class, 'show']);
Route::get('post/{id}-{slug}', [ChiTietBaiDangController::class, 'show']);
Route::get('community', [PageController::class, 'getCommunity'])->name('community');
Route::resource('cooperate','App\Http\Controllers\DangKyHopTacController');
Route::get('search', [PageController::class, 'search'])->name('search');
Route::post('login', [LoginController::class, 'authenticate'])->name('login');
Route::get('logout',[LoginController::class, 'logout'])->name('logout');    
Route::resource('register','App\Http\Controllers\RegisterController');







//Admin

Route::get('dashboard', [PageController::class, 'indexAdmin'])->name('admin.dashboard');
Route::resource('quyen','App\Http\Controllers\QuyenController');
Route::resource('taikhoan','App\Http\Controllers\UserController');
Route::get('phim', [PhimAdminController::class, 'index'])->name('admin.phim.index');
Route::get('phim/{id}', [PhimAdminController::class,'show'])->name('admin.phim.show');
Route::resource('baidang','App\Http\Controllers\BaiDangController');
Route::resource('binhluan','App\Http\Controllers\BinhLuanController');
Route::get('danhgia',[DanhGiaController::class,'indexAdmin'])->name('admin.danhgia.index');
Route::delete('danhgia/{id}','DanhGiaController@destroy');
Route::resource('goidangky','App\Http\Controllers\GoiDangKyController');
Route::resource('dangkyquangcao','App\Http\Controllers\QuanLyHopTacController');
Route::get('phanquyen',[UserController::class,'getPhanQuyen'])->name('phanquyen.index');
Route::post('phanquyen','UserController@postPhanQuyen');

Route::get('/', function () {
    return view('welcome');
});
