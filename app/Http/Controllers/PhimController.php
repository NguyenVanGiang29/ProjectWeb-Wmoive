<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Phim;
use App\Models\TheLoai;

class PhimController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $phims = Phim::all();
        $theLoais = TheLoai::all();

        view()->share(compact('phims'));
        view()->share(compact('theLoais'));
    }

    public function postHotphim($id){
        $phim = Phim::find($id);
        if($phim->trang_thai == 1){
            $phim->trang_thai = 0;
        }else{
            $phim->trang_thai =1;
        }
        $phim->update();

        return back();
    }

    public function __invoke(Request $request)
    {
        //
    }
}
