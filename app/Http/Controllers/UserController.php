<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use App\Models\Quyen;
use App\Models\GoiDangKy;
use File;
use Hash;
use DD;

class UserController extends Controller
{
    function __construct()
    {
        $users = User::with('quyen')->get();
        $quyens = Quyen::all();
        $goiDangKys = GoiDangKy::all();

        view()->share(compact('users'));
        view()->share(compact('quyens'));
        view()->share(compact('goiDangKys'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.taikhoan.index');
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
        $validator = Validator::make($request->all(), [
            'ten_hien_thi' => 'min:3|max:40',
            'email' => 'unique:users|min:3|max:255',
            'hinh_dai_dien' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ],
        [
            'ten_hien_thi.min'=>'Tên ít nhất :min ký tự',
            'ten_hien_thi.max'=>'Tên nhiều nhất :max ký tự',
            'email.unique'=>'Email này đã có người sử dụng',
            'email.min'=>'Email ít nhất :min ký tự',
            'email.max'=>'Email nhiều nhất :max ký tự',
            'hinh_dai_dien.image'=>'File bạn chọn không phải ảnh',
            'hinh_dai_dien.mimes'=>'Đuôi file của bạn phải thuộc các đuôi: jpeg, png, jpg, gif, svg',
        ]);
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput()->with(['error_themtaikhoan'=>'Lỗi thêm tài khoản']);
        }
        $hinhDaiDien = "";
        if($request->hasFile('hinh_dai_dien'))
        {
            $file = $request->file('hinh_dai_dien');
            $name = $file->getClientOriginalName();
            $hinhDaiDien = time().'_'.$name;
            $file->move(public_path('upload/users'), $hinhDaiDien);
        }
        else
            $hinhDaiDien = "no-image.svg";

        $user = new User;
        $user->email = $request->email;
        $user->password = Hash::make(123456); //mật khẩu mặc định 123456
        $user->ten_hien_thi = $request->ten_hien_thi;
        $user->hinh_dai_dien = $hinhDaiDien;
        $user->goidangky_id = $request->goidangky_id;
        $user->quyen_id = $request->quyen_id;
        $user->save();
            
        return back()->with(['thong-bao' => 'Thêm thành công!', 'type' => 'success']);
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
        return response()->json(User::findOrFail($id), 200);
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
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'ten_hien_thi' => 'min:3|max:40',
            'hinh_dai_dien' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ],
        [
            'ten_hien_thi.min'=>'Tên ít nhất :min ký tự',
            'ten_hien_thi.max'=>'Tên nhiều nhất :max ký tự',
            'hinh_dai_dien.image'=>'File bạn chọn không phải ảnh',
            'hinh_dai_dien.mimes'=>'Đuôi file của bạn phải thuộc các đuôi: jpeg, png, jpg, gif, svg',
        ]);
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput()->with(['error_capnhattaikhoan'=>'Lỗi cập nhật tài khoản']);
        }
        if($request->hinh_dai_dien)
        {
            if (File::exists("upload/users/".$user->hinh_dai_dien && $user->hinh_dai_dien!="no-image.svg")) {
                File::delete("upload/users/".$user->hinh_dai_dien);
            }
            $hinhDaiDien = "";
            if($request->hasFile('hinh_dai_dien'))
            {
                $file = $request->file('hinh_dai_dien');
                $name = $file->getClientOriginalName();
                $hinhDaiDien = time().'_'.$name;
                $file->move(public_path('upload/users'), $hinhDaiDien);
            }
            $user->hinh_dai_dien = $hinhDaiDien;
        }
        
        $user->ten_hien_thi = $request->ten_hien_thi;
        $user->goidangky_id = $request->goidangky_id;
        $user->quyen_id = $request->quyen_id;
        $user->update();
            
        return back()->with(['thong-bao' => 'Cập nhật thành công!', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $hinhDaiDien = $user->hinh_dai_dien;
        if (File::exists("upload/users/".$hinhDaiDien && $hinhDaiDien!="no-image.svg")) {
            File::delete("upload/users/".$hinhDaiDien);
        }
        $user->delete();

        return back()->with(['thong-bao'=>'Xoá thành công!', 'type'=>'success']);
    }

    public function getPhanQuyen()
    {
        return view('admin.taikhoan.phanquyen');
    }

    public function postPhanQuyen(Request $request)
    {
        $user = User::findOrFail($request->userId);
        $user->quyen_id = $request->quyenId;
        $user->save();
        return response()->json([
          'error' => false,
          'mess'=>'Đã đổi phân quyền',
        ], 200);
    }

    public function uploadHinh(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'hinh_dai_dien' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',        
            ],
            [
                'hinh_dai_dien.image'=>'File bạn chọn không phải ảnh',
                'hinh_dai_dien.mimes'=>'Đuôi file của bạn phải thuộc các đuôi: jpeg, png, jpg, gif, svg',
                'hinh_dai_dien.max'=>'Dung lượng file tối đa :max byte',
            ]
        );
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput()->with(['error_suaanh'=>'Lỗi cập nhật ảnh', 'type'=> 'danger']);
        }
        $tenCu = Auth::user()->hinh_dai_dien;
        $hinhDaiDien = "";
        if($request->hasFile('hinh_dai_dien'))
        {
            $file = $request->file('hinh_dai_dien');
            $name = $file->getClientOriginalName();
            $hinhDaiDien= time().'_'.$name;
            $file->move(public_path('upload/users'), $hinhDaiDien);
        }
        try {
            $user = Auth::user();
            $user->hinh_dai_dien = $hinhDaiDien;
            $user->update();
        } catch (Exception $e) {
            return back()->with(['thongbao' => $e->getMessage(), 'type' => 'danger']);
        }
        if (File::exists("upload/users/".$tenCu) && $tenCu!="no-image.svg" ) {
            File::delete("upload/users/".$tenCu);
        }

        return back()->with(['thongbao' => 'Thay đổi ảnh đại diện thành công!', 'type' => 'success']);
    }

    public function changePassWord(Request $request)
    {
        $data = Validator::make($request->all(),
        [
            'password' => 'min:6|max:255',
            'new_password' => 'min:6|max:255|confirmed:re_new_password',
        ],
        [
            'password.min' => 'Mật khẩu ít nhất :min ký tự',
            'password.max' => 'Mật khẩu nhiều nhất :max ký tự',
            'new_password.min' => 'Mật khẩu ít nhất :min ký tự',
            'new_password.max' => 'Mật khẩu nhiều nhất :max ký tự',
            'new_password.confirmed' => 'Mật khẩu xác nhận không đúng',
        ]);

        if($data->fails())
            return back()
                    ->withErrors($data)
                    ->withInput()
                    ->with(['error_changepassword' => 'Lỗi']);

        if (Hash::check($request->password, auth()->user()->password)) {
            try {
                auth()->user()->update(['password'=>Hash::make($request->new_password)]);
            } catch (Exception $e) {
                return back()->with(['thong-bao'=>$e->getMessage(),'type'=>'danger']);
            }
        }
        else{
            return back()->with(['thong-bao'=>'Mật khẩu cũ không đúng!','type'=>'danger']);
        }
        
        return back()->with(['thong-bao'=>'Đổi mật khẩu thành công!','type'=>'success']);
    }
}
