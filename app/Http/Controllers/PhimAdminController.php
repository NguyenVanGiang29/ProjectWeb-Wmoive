<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\DanhGia;

class PhimAdminController extends Controller
{
    function __construct()
    {
        $phims = Phim::with('user')->orderby('ngay_khoi_chieu', 'desc')->get();
        view()->share(compact('phims'));
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('admin.phim.index');
    }

    public function show($id)
    {
        $phim = Phim::findOrFail($id);
        return view('admin.phim.show', compact('phim'));
    }

    function get_countDanhGia($phimId)
    {
        return DanhGia::where('phim_id', $phimId)->count();
    }

    function get_diemTrungBinh($phimId)
    {
        return DanhGia::where('phim_id', $phimId)->avg('diem');
    }
     
    public function __invoke(Request $request)
    {
        //
    }
}
