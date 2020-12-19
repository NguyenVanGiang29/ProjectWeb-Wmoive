<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\DanhGia;

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

    public function __invoke(Request $request)
    {
        //
    }
}
