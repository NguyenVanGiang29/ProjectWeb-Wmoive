<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiBaiDang;
use App\Models\GoiDangKy;
use App\Models\User;
use Validator;
use Hash;

class DangKyHopTacController extends Controller
{

    public function __construct()
    {
        $loaiBaiDangs = LoaiBaiDang::all();
        $goiDangKys = GoiDangKy::all();

        view()->share(compact('loaiBaiDangs'));
        view()->share(compact('goiDangKys'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dangkyhoptac');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'ten_hien_thi'=>'min:3|max:40',
                'email'=>'unique:users|min:3|max:255',
                'password'=>'confirmed|min:6'
                // 'hinh_dai_dien'
            ],
            [
                'ten_hien_thi.min'=>'Tên ít nhất :min ký tự',
                'ten_hien_thi.max'=>'Tên nhiều nhất :max ký tự',
                'email.unique'=>'Email này đã có người sử dụng',
                'email.min'=>'Email ít nhất :min ký tự',
                'email.max'=>'Email nhiều nhất :max ký tự',
                'password.confirmed'=>'Nhập lại mật khẩu chưa đúng',
                'password.min'=>'Mật khẩu ít nhất :min ký tự',
            ]
        );
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput()->with(['error_dangkyhoptac'=>'Loi dang ky']);
        }

        $hinh_dai_dien = '';

        if($request->hasFile('hinh_dai_dien'))
        {
            $file = $request->file('hinh_dai_dien');
            $name = $file->getClientOriginalName();
            $hinh_dai_dien= time().'-'.$name;
            $file->move(public_path('upload/users'), $hinh_dai_dien);
        }
        else {
            $hinh_dai_dien = 'no-image.svg';
        }

        $user = new User;
        $user->email = $request->email;
        $user->ten_hien_thi = $request->ten_hien_thi;
        $user->password = Hash::make($request->password);
        $user->hinh_dai_dien = $hinh_dai_dien;
        $user->goidangky_id = $request->goi_dang_ky;
        $user->trang_thai = 2;
        $user->quyen_id = 2;
        $user->save();

        return back()->with(['thongbao' => 'Đăng ký thành công', 'type' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
