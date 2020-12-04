<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhGia;
use Illuminate\Support\Facades\Auth;
    

class DanhGiaController extends Controller
{
    function __construct()
    {
        $danhGias = DanhGia::with('user', 'phim')->get();

        view()->share(compact('danhGias'));
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    
    public function indexAdmin()
    {
        return view('admin.danhgia.index');
    } 

    public function destroy($id)
    {
        $danhGia = DanhGia::findOrFail($id);
        $danhGia->delete();
        return back()->with(['thongbao'=>'Xoá thành công','type'=>'success']);
    }
    
    public function __invoke(Request $request)
    {
        //
    }
}
