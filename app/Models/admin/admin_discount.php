<?php

namespace App\Models\admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class admin_discount extends Model
{
    use HasFactory;

    public function getAllDiscount(){
        $discount = DB::select("SELECT DATEDIFF(NOW(), NgayBatDau) AS SoNgayDaApDung, DATEDIFF(NOW(), NgayHetHan) AS SoNgayConLai, PhanTramKM, MaKM, TrangThai ,DATE_FORMAT(NgayBatDau, '%d/%m/%Y') AS NgayBatDau, DATE_FORMAT(NgayHetHan, '%d/%m/%Y') AS NgayHetHan FROM khuyenmai ORDER BY MaKM DESC");
        $discountDetail = DB::select("SELECT sanpham.MaSP, sanpham.TenSP, sanpham.DonGia, hinhanh.TenAnh, khuyenmai.PhanTramKM, khuyenmai.MaKM FROM sanpham, hinhanh, khuyenmai, chitietkhuyenmai WHERE sanpham.MaSP = hinhanh.MaSP AND sanpham.MaSP = chitietkhuyenmai.MaApDung AND khuyenmai.MaKM = chitietkhuyenmai.MaKM AND hinhanh.LoaiAnh = 1");

        // dd($discountDetail);
        return [$discount, $discountDetail];
    }

    public function addDiscount($data){
        $phantramkm = $data['phantramkm'];
        $ngaybatdau = $data['ngaybatdau'];
        $ngayhethan = $data['ngayketthuc'];

        DB::select("INSERT INTO `khuyenmai`(`PhanTramKM`, `NgayBatDau`, `NgayHetHan`, `TrangThai`) VALUES ('$phantramkm','$ngaybatdau','$ngayhethan','0')");
    }

    public function changeDiscountStatus($id){
        $data = DB::select("SELECT TrangThai FROM khuyenmai WHERE MaKM = $id");
        if($data[0]->TrangThai == 0){
            DB::select("UPDATE `khuyenmai` SET `TrangThai`='1' WHERE MaKM = $id");
        }else{
            DB::select("UPDATE `khuyenmai` SET `TrangThai`='0' WHERE MaKM = $id");
        }
    }

    public function getAllProduct($MaKM){
        $khuyemai = DB::select("SELECT * FROM khuyenmai WHERE MaKM = $MaKM")[0];
        $discount = DB::select("SELECT * FROM khuyenmai WHERE MaKM = $MaKM")[0]->PhanTramKM;
        $discountDetail = DB::select("SELECT sanpham.MaSP, sanpham.TenSP, sanpham.DonGia, hinhanh.TenAnh, khuyenmai.PhanTramKM, khuyenmai.MaKM, khuyenmai.PhanTramKM FROM sanpham, hinhanh, khuyenmai, chitietkhuyenmai WHERE sanpham.MaSP = hinhanh.MaSP AND sanpham.MaSP = chitietkhuyenmai.MaApDung AND khuyenmai.MaKM = chitietkhuyenmai.MaKM AND hinhanh.LoaiAnh = 1");
        $product = DB::select("SELECT * FROM sanpham, hinhanh WHERE hinhanh.MaSP = sanpham.MaSP AND LoaiAnh = 1");
        return [$discountDetail, $product, $discount, $khuyemai];
    }

    public function handleAddProductToDiscount($data){
        $MaKM = $data['MaKM'];
        $ngaybatdau = $data['date_start'];
        $ngayhethan = $data['date_end'];
        $phantramkm = $data['phantramkm'];
        DB::select("UPDATE `khuyenmai` SET `PhanTramKM`='$phantramkm',`NgayBatDau`='$ngaybatdau',`NgayHetHan`='$ngayhethan' WHERE MaKM = $MaKM");
        if($data['inList'] != null){
            $inlist = explode("|", $data['inList']);
            array_pop($inlist);
            foreach($inlist as $item1){
                DB::select("INSERT INTO `chitietkhuyenmai`(`MaKM`, `MaApDung`) VALUES ('$MaKM','$item1')");
            }
        }

        if($data['outList'] != null){
            $outlist = explode("|", $data['outList']);
            array_pop($outlist);
            foreach($outlist as $item2){
                DB::select("DELETE FROM `chitietkhuyenmai` WHERE MaKM = $MaKM AND MaApDung = $item2");
            }
        }
    }

    public function deleteDiscount($id){
        DB::select("DELETE FROM `khuyenmai` WHERE MaKM = $id");
    }
}
