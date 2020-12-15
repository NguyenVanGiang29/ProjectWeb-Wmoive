<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\LoaiBaiDang;
use App\Models\DanhGia;

class ChiTietPhimController extends Controller
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

    public function show($phim, $slug)
    {
        $phim = Phim::findOrFail($phim);
        $danhGias = DanhGia::with('user')->orderby('created_at', 'desc')->get();
        return view('pages.chitietphim', compact('phim', 'danhGias'));
    }

    public function __invoke(Request $request)
    {
        //
    }
}
