<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\BaiDang;
use DB;

class PageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  
     * @return \Illuminate\Http\Response
     */

    public function indexAdmin()
    {
        return view('admin.dashboard');
    } 

    public function getHome()
    {
        $phims = Phim::with('doTuoi', 'user')->where('trang_thai',1)->get();
        $tinTucs = BaiDang::with('loaiBaiDang', 'user')->where('loaibd_id', 1)
                            ->where('trang_thai', 0)
                            ->orderby('created_at', 'desc')
                            ->take(6)->get();
        $baiViets = BaiDang::with('loaiBaiDang', 'user')->where('loaibd_id','!=', 1)
                            ->where('trang_thai', 0)
                            ->orderby('created_at', 'desc')
                            ->take(6)->get();

        return view('pages.home',compact('phims', 'tinTucs','baiViets'));
    }

    public function __invoke(Request $request)
    {
        //
    }
}
