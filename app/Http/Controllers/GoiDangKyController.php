<?php

namespace App\Http\Controllers;

use App\Models\GoiDangKy;
use Illuminate\Http\Request;
use Validator;
use Exception;
use DD;

class GoiDangKyController extends Controller
{
    public function __construct()
    {
        $goiDangKys = GoiDangKy::all();

        view()->share('goiDangKys', $goiDangKys);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.goidangky.index');
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
                'ten_goi'=>'max:255',
                'so_luong_phim'=>'max:3',
                'thang'=>'max:2'
            ],
            [
                'ten_goi.max'=>'Tên gói nhiều nhất :max ký tự',
                'so_luong_phim.max'=>'Số lượng phim có nhiều nhất :max số',
                'thang.max'=>'Tháng nhiều nhất có :max số',
            ]
        );
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput()->with(['error_themgoidk' => 'Lỗi thêm gói']);
        }

        try {
            GoiDangKy::create($request->only(['ten_goi', 'so_luong_phim', 'thang']));
        } catch (Exception $e) {
            return back()->with($e->getMessage());
        }

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
        return response()->json(GoiDangKy::findOrFail($id), 200);
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
        $validator = Validator::make($request->all(),
            [
                'ten_goi'=>'max:255',
                'so_luong_phim'=>'max:3',
                'thang'=>'max:2'
            ],
            [
                'ten_goi.max'=>'Tên gói nhiều nhất :max ký tự',
                'so_luong_phim.max'=>'Số lượng phim có nhiều nhất :max số',
                'thang.max'=>'Tháng nhiều nhất có :max số',
            ]
        );
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput()->with(['error_capnhatgoidk' => 'Lỗi thêm gói']);
        }

        $goiDangKy = GoiDangKy::findOrFail($id);

        $goiDangKy->ten_goi = $request->ten_goi;
        $goiDangKy->so_luong_phim = $request->so_luong_phim;
        $goiDangKy->thang = $request->thang;

        $goiDangKy->save();

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
        $goiDangKy = GoiDangKy::findOrFail($id);
        $goiDangKy->delete();
        return back()->with(['thong-bao' => 'Xoá thành công!', 'type' => 'success']);
    }
}
