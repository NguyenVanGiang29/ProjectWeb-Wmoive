<?php

namespace App\Http\Controllers;

use App\Models\Quyen;
use Illuminate\Http\Request;
use Validator;
use Exception;

class QuyenController extends Controller
{
    function __construct()
    {
        $quyens = Quyen::all();

        view()->share(compact('quyens'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.quyen.index');
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
        //
        $validator = Validator::make($request->all(),
            [
                'ten_quyen' => 'min:3|max:255'
            ],
            [
                'ten_quyen.min'=>'Tên quyền phải có ít nhất :min kí tự',
                'ten_quyen.max'=>'Tên quyền phải có nhiều nhất :max kí tự'
            ]
        );
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput()->with(['error_themquyen'=>'Loi them quyen']);
        }

        Quyen::create($request->only('ten_quyen'));

        return back()->with(['thong-bao'=>'Thêm thành công','type'=>'success']);
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
    public function edit(Quyen $quyen)
    {
        return response()->json($quyen, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quyen $quyen)
    {
        $validator = Validator::make($request->all(),
            [
                'ten_quyen' => 'min:3|max:255'
            ],
            [
                'ten_quyen.min'=>'Tên quyền phải có ít nhất :min kí tự',
                'ten_quyen.max'=>'Tên quyền phải có nhiều nhất :max kí tự'
            ]
        );
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput()->with(['error_capnhatquyen'=>'Loi cap nhat quyen']);
        }

        $quyen->update(['ten_quyen' => $request->ten_quyen]);

        return back()->with(['thong-bao'=>'Cập nhật thành công!','type'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quyen $quyen)
    {
        try {
            $quyen->delete();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return back()->with(['thong-bao' => 'Xoá thành công!', 'type' => 'success']);
    }
}
