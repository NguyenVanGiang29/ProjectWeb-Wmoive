<?php
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\DanhGia;
use App\Models\Phim;
use App\Models\TheLoai;
use App\Models\TheLoaiPhim;
use App\Models\User;
use App\Models\GoiDangKy;
use App\Models\Thich;

function get_now()
{
    Carbon::setLocale('vi');
    return Carbon::now();
}

function check_role()
{
    $quyenId = Auth::user()->quyen_id;
    if($quyenId == 1) return 'admin/dashboard';
    if($quyenId == 2) return 'hangphim/dashboard';
}

function get_allPhim($userId)
{
    return Phim::where('user_id', $userId)->get();
}

function get_danhGiaHp()
{
    return DanhGia::whereIn('phim_id', Phim::where('user_id', auth()->user()->id)->pluck('id'))
            ->orderby('diem', 'asc')->get();
}

// Function đánh giá
function is_daDanhGia($phimId)
{
    $userId = Auth::user()->id;
    
    return DanhGia::where('phim_id', $phimId)->where('user_id', $userId)->count();
}

function check_danhGia($danhGiaId)
{
    $userId = Auth::user()->id;
    return DanhGia::where('user_id', $userId)->count();
}

function get_countDanhGia($phimId)
{
    return DanhGia::where('phim_id', $phimId)->count();
}
function get_diemTrungBinh($phimId)
{
    return DanhGia::where('phim_id', $phimId)->avg('diem');
}

//
function get_trangThaiPhim($trangthai)
{
    if($trangthai == 1)
        echo 'Đang hot';
    else
        echo 'Mặc định';
}

function get_newDanhGia($phimId)
{
    return Phim::where('id', $phimId);
}

function get_theLoaiPhim($phimId)
{
    $theLoaiPhims = TheLoaiPhim::where('phim_id', $phimId)->get();
    foreach ($theLoaiPhims as $value) {
        $mang = TheLoai::where('id',$value->theloai_id)->get();
        foreach ($mang as $value) {
            echo $value->ten_the_loai.", ";
        }
    }
}

function get_trangThaiUser($trangThai)
{
    if($trangThai == 0)
        echo "Bình thường";
    if($trangThai == 1)
        echo "Đã bị khoá";
    if($trangThai == 2)
        echo "Chưa duyệt";
}

function get_trangThaiBaiDang($trangThai)
{
    if($trangThai == 0)
        echo "Hiển thị";
    else
        echo "Ẩn";
}

function get_countDuyet()
{
    return User::where('quyen_id',2)->where('trang_thai',2)->count();
}

function get_goiDangKy()
{
    $userId = Auth::user()->id;
    $goiDangKyId = User::where('id', $userId)->first()->goidangky_id;
    return GoiDangKy::where('id', $goiDangKyId)->first()->so_luong_phim;
}

function get_demGoiDangKy()
{
    $userId = Auth::user()->id;
    $phim = Phim::where('user_id', $userId)->count();
    $soluong = get_goiDangKy();

    return $soluong - $phim;
}

function get_mangTheLoaiPhim($idPhim)
{
    $theLoaiPhims = TheLoaiPhim::where('phim_id', $idPhim)->get();
    $mangTheLoai = array();
    foreach ($theLoaiPhims as $value) {
        array_push($mangTheLoai, $value->theloai_id);
    }

    return $mangTheLoai;
}

function get_thangDangKy()
{
    $userId = Auth::user()->id;
    $goiDangKyId = User::where('id', $userId)->first()->goidangky_id;
    return GoiDangKy::where('id', $goiDangKyId)->first()->thang;
}

function get_ngayDuyetDangKy()
{
    $userId = Auth::user()->id;
    return User::where('id', $userId)->first()->ngay_duyet_dang_ky;
}

function get_thangSau()
{
    $userId = Auth::user()->id;
    $ngayDuyet = User::where('id', $userId)->first()->ngay_duyet_dang_ky;
    return date('d-m-Y', strtotime('+'.get_thangDangKy().' month', strtotime($ngayDuyet)));
}

function checkHanDangKy()
{
    $day_1 = get_thangSau();
    $day_2 = date("d-m-Y");
    return (strtotime($day_1) - strtotime($day_2)) / (60 * 60 * 24);
}

function get_demNgayDangKy()
{
    echo get_thangSau();
}

function get_demKetQuaSearch($phims, $baiDangs)
{
    return $phims->count() + $baiDangs->count();
}

function get_demLuotThich($baiDangId)
{
    $countLike = Thich::where('baidang_id', $baiDangId)->where('thich', 1)->count();
    $countDislike = Thich::where('baidang_id', $baiDangId)->where('thich', 0)->count();
    return $countLike - $countDislike;
}