<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiBaiDang;
use App\Models\BaiDang;
use Illuminate\Support\Facades\Session;

class ChiTietBaiDangController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $loaiBaiDangs = LoaiBaiDang::all();

        view()->share(compact('loaiBaiDangs'));
    }

    public function show($baiDang, $slug)
    {
        $sessionKey = 'post_' . $baiDang;
        $sessionView = Session::get($sessionKey);
        $baiDang = BaiDang::findOrFail($baiDang);
        if (!$sessionView) { //nếu chưa có session
            Session::put($sessionKey, 1); //set giá trị cho session
            $baiDang->increment('luot_xem');
        }
        return view('pages.baidang', compact('baiDang'));
    }

    public function __invoke(Request $request)
    {
        //
    }
}
