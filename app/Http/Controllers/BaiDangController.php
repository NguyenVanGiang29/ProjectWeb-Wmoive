<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BaiDang;
use App\Models\LoaiBaiDang;
use Validator;
use File;

class BaiDangController extends Controller
{
    function __construct()
    {
        $loaiBaiDangs = LoaiBaiDang::all();

        view()->share(compact('loaiBaiDangs'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $baiDangs = BaiDang::with('loaiBaiDang', 'user')->orderby('created_at', 'desc')->get();
        return view('admin.baidang.index', compact('baiDangs'));
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
                'tieu_de'=>'min:2|max:255',
                'anh_poster'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'noi_dung'=>'required|min:100',
            ],
            [
                'tieu_de.min'=>'Tiêu đề ít nhất :min ký tự',
                'tieu_de.max'=>'Tiêu đề nhiều nhất :max ký tự',
                'anh_poster.required'=>'Bạn chưa chọn ảnh bìa',
                'anh_poster.image'=>'Bạn vui lòng chọn file ảnh',
                'anh_poster.mimes'=>'Bạn vui lòng chọn các file :mines',
                'anh_poster.max'=>'Kích thước tối đa là :max byte',
                'noi_dung.required'=>'Bạn chưa nhập nội dung',
                'noi_dung.min'=>'Nội dung của bạn ít nhất :min ký tự',
            ]
        );
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput()->with(['error_post'=>'Lỗi đăng bài']);
        }
        $anh_poster = '';
        if($request->hasFile('anh_poster'))
        {
            $file = $request->file('anh_poster');
            $name = $file->getClientOriginalName();
            $anh_poster= time().'_'.$name;
            $file->move(public_path('upload/post'), $anh_poster);
        }

        $userPost = Auth::user()->id;
    	try {
    		BaiDang::create($request->only(['tieu_de','loaibd_id','noi_dung'])+['anh_poster'=>$anh_poster]+['user_id'=>$userPost]);
    	} catch (Exception $e) {
    		return back()->with(['thongbao'=>$e->getMessage(),'type'=>'danger']);
    	}
    	return back()->with(['thongbao'=>'Thêm thành công','type'=>'success']);
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
        $baiDang = BaiDang::findOrFail($id);
        return response()->json($baiDang, 200);
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
        $baiDang = BaiDang::findOrFail($id);
        $validator = Validator::make($request->all(),
            [
                'tieu_de1'=>'min:2|max:255',
                'anh_poster1'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'noi_dung1'=>'required|min:100',
            ],
            [
                'tieu_de1.min'=>'Tiêu đề ít nhất :min ký tự',
                'tieu_de1.max'=>'Tiêu đề nhiều nhất :max ký tự',
                'anh_poster1.image'=>'Bạn vui lòng chọn file ảnh',
                'anh_poster1.mimes'=>'Bạn vui lòng chọn các file :mines',
                'anh_poster1.max'=>'Kích thước tối đa là :max byte',
                'noi_dung1.required'=>'Bạn chưa nhập nội dung',
                'noi_dung1.min'=>'Nội dung của bạn ít nhất :min ký tự',
            ]
        );
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput()->with(['error_updatePost'=>'Lỗi cập nhật bài đăng']);
        }
        $curentPoster = $baiDang->anh_poster;
        $anhPoster = $request->anh_poster1;
        if($anhPoster)
        {
            if (File::exists("upload/post/".$curentPoster)) {
                File::delete("upload/post/".$curentPoster);
            }
            $anh_poster = '';
            if($request->hasFile('anh_poster1'))
            {
                $file = $request->file('anh_poster1');
                $name = $file->getClientOriginalName();
                $anh_poster= time().'_'.$name;
                $file->move(public_path('upload/post'), $anh_poster);
            }
            $baiDang->anh_poster = $anh_poster;
        }
        $baiDang->tieu_de = $request->tieu_de1;
        $baiDang->noi_dung = $request->noi_dung1;
        $baiDang->loaibd_id = $request->loaibd_id1;
        $baiDang->update();
    	return back()->with(['thongbao'=>'Cập thành công!','type'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $baiDang = BaiDang::findOrFail($id);
        $curentPoster = $baiDang->anh_poster;
        if (File::exists("upload/post/".$curentPoster)) {
            File::delete("upload/post/".$curentPoster);
        }
        $baiDang->delete();
        return back()->with(['thongbao'=>'Xoá thành công!','type'=>'success']);
    }

    public function postAnbaidang($id){
        $baiDang = BaiDang::findOrFail($id);
        if($baiDang->trang_thai == 1){
            $baiDang->trang_thai = 0;
        }else{
            $baiDang->trang_thai = 1;
        }

        $baiDang->update();
        return back();
    }
}
