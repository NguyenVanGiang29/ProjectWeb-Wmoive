<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Exception;
use Illuminate\Support\Facades\Auth;
use Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
                'email'=>'unique:users|min:3|max:255',
                'name'=>'min:3|max:40',
                'password'=>'confirmed|min:6'
            ],
            [
                'email.unique'=>'Email này đã có người sử dụng',
                'email.min'=>'Email ít nhất :min ký tự',
                'email.max'=>'Email nhiều nhất :max ký tự',
                'name.min'=>'Tên ít nhất :min ký tự',
                'name.max'=>'Tên nhiều nhất :max ký tự',
                'password.confirmed'=>'Nhập lại mật khẩu chưa đúng',
                'password.min'=>'Mật khẩu ít nhất :min ký tự',
            ]
        );
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput()->with(['error_register'=>'Loi dang ky']);
        }
        $user = new User;
        $user->ten_hien_thi = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->hinh_dai_dien = 'no-image.svg';
        $user->quyen_id = 3;
        $user->save();
        Auth::login($user);
        return redirect()->back();
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
        try {
            Auth::user()->update($request->only(['ten_hien_thi']));
        } catch (Exception $e) {
            return back()->with(['thong-bao' => $e->getMessage(), 'type' => 'danger']);
        }
            
        return back()->with(['thong-bao' => 'Cập nhật thành công', 'type' => 'success']);
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
