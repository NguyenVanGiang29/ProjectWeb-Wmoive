<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\DanhGia;
use App\Models\BaiDang;
use App\Models\BinhLuan;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function loadDanhGia($phimId)
    {
        $phim = Phim::findOrFail($phimId);
        $danhGias = DanhGia::with('user')->where('phim_id', $phimId)->orderby('created_at', 'desc')->get();
        return view('subpages.danhgia', compact('phim', 'danhGias'));
    }

    public function postDanhGia(Request $request)
    {
        $user_id = Auth::user()->id;
        $check = DanhGia::where('phim_id', $request->phim_id)->where('user_id', $user_id)->count();
		if($check == 0){
			try {
				DanhGia::create($request->only(['diem','noi_dung','phim_id'])+['user_id'=>$user_id]);
			} catch (Exception $e) {
				return $e->getMessage();    
			}
			return response()->json([
				'error'=>false,
				'thongbao'=>'Đánh giá thành công',
			],200);
		}
		else{
			return response()->json([
				'error'=>true,
				'thongbao'=>'Không được phép đánh giá',
			],200);
		}
    }

    public function loadBinhLuan($baiDangId)
    {
        $baiDang = BaiDang::findOrFail($baiDangId);
        $binhLuans = BinhLuan::with('user')->where('baidang_id', $baiDangId)->orderby('created_at', 'desc')->get();
        return view('subpages.binhluan', compact('baiDang', 'binhLuans'));
    }

    public function postBinhLuan(Request $request)
    {
        $user_id = Auth::user()->id;
        try {
            BinhLuan::create($request->only(['noi_dung','baidang_id'])+['user_id'=>$user_id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return response()->json([
            'error'=>false,
            'thongbao'=>'Đánh giá thành công',
        ],200);
    }

    public function getXoaBinhLuan($binhLuanId)
    {
        $binhLuan = BinhLuan::findOrFail($binhLuanId);
		try {
			$binhLuan->delete();
		} catch (Exception $e) {
			return response()->json([
				'error'=>true,
			],200);
		}
		return response()->json([
			'error'=>false,
		],200);
    }

    public function postCapNhatDanhGia(Request $request)
    {
        $user = Auth::user();
        $danhGia = DanhGia::findOrFail($request->danhGiaId);
		if($danhGia){
			try {
				$danhGia->diem = $request->diemCapNhat;
                $danhGia->noi_dung = $request->noiDungCapNhat;
                $danhGia->phim_id = $request->phimId;
                $danhGia->user_id = $user->id;
                $danhGia->update();
			} catch (Exception $e) {
				return $e->getMessage();
			}
			return response()->json([
				'error'=>false,
				'thongbao'=>'Cập nhật thành công',
			],200);
		}
		else{
			return response()->json([
				'error'=>true,
				'thongbao'=>'Không tìm thấy đánh giá',
			],200);
		}
    }

    public function __invoke(Request $request)
    {
        //
    }
}
