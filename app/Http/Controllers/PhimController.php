<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function __invoke(Request $request)
    {
        //
    }
}
