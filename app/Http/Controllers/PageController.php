<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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


    public function __invoke(Request $request)
    {
        //
    }
}
