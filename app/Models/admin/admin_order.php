<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Support\Facades\DB;

class admin_order extends Model
{
    use HasFactory;

    public function getAllOrder($TrangThai)
    {
        if ($TrangThai == 0) {
            $MaTK = session()->get('user');
            $order = DB::select("SELECT * FROM `donhang` ORDER BY MaDH DESC");
            $arr1 = [];
            foreach ($order as $item) {
                $orderDetail = DB::select("SELECT * FROM chitietdonhang WHERE MaDH = $item->MaDH");
                $sum = 0;
                foreach ($orderDetail as $item1) {
                    $sum += $item1->DonGia * $item1->SoLuong;
                }
                array_push($arr1, [
                    substr(strtoupper(md5($item1->MaDH . $item1->MaSP)), 0, 12),
                    $item->NgayDat,
                    $sum + 30000,
                    $item->LoaiThanhToan,
                    $item->TrangThai,
                    $item->MaDH,
                    $item->SoDienThoai,
                    $item->TenNguoiNhan
                ]);
            }

            $orderDetail = DB::select("SELECT * FROM chitietdonhang");
            return [$arr1, $orderDetail];
        } else {
            $MaTK = session()->get('user');
            $order = DB::select("SELECT * FROM `donhang` WHERE TrangThai = $TrangThai ORDER BY MaDH DESC");
            $arr1 = [];
            foreach ($order as $item) {
                $orderDetail = DB::select("SELECT * FROM chitietdonhang WHERE MaDH = $item->MaDH");
                $sum = 0;
                foreach ($orderDetail as $item1) {
                    $sum += $item1->DonGia * $item1->SoLuong;
                }
                array_push($arr1, [
                    substr(strtoupper(md5($item1->MaDH . $item1->MaSP)), 0, 12),
                    $item->NgayDat,
                    $sum + 30000,
                    $item->LoaiThanhToan,
                    $item->TrangThai,
                    $item->MaDH,
                    $item->SoDienThoai,
                    $item->TenNguoiNhan
                ]);
            }

            $orderDetail = DB::select("SELECT * FROM chitietdonhang");
            return [$arr1, $orderDetail];
        }
    }

    public function orderDetail($orderId)
    {
        $orders = DB::select("SELECT donhang.NgayDat, donhang.DiaChi, donhang.SoDienThoai, donhang.TenNguoiNhan, donhang.GhiChu, donhang.TrangThai, donhang.LoaiThanhToan, chitietdonhang.SoLuong, chitietdonhang.DonGia, sanpham.TenSP, sanpham.MaTraCuu, chitietdonhang.KichThuoc, sanpham.LoaiKichThuoc, sanpham.MaSP, sanpham.SoLuong as SL FROM sanpham, donhang, chitietdonhang WHERE donhang.MaDH = chitietdonhang.MaDH AND donhang.MaDH = $orderId AND sanpham.MaSP = chitietdonhang.MaSP");
        $data = DB::select("SELECT sanpham.MaSP, sanpham.TenSP, hinhanh.TenAnh, sanpham.TrangThai, sanpham.DonGia, sanpham.LoaiKichThuoc, sanpham.SoLuong, loaisanpham.TenLoai, danhmuc.TenDanhMuc FROM sanpham, hinhanh, danhmuc, loaisanpham WHERE sanpham.MaLoai = loaisanpham.MaLoai AND sanpham.MaSP = hinhanh.MaSP AND danhmuc.MaDanhMuc = loaisanpham.MaDanhMuc AND hinhanh.LoaiAnh = 1");
        $result = [];

        foreach ($data as $key => $item) {
            $check = DB::select('SELECT DATEDIFF(NOW(), NgayBatDau) AS SoNgayDaApDung, DATEDIFF(NOW(), NgayHetHan) AS SoNgayConLai, khuyenmai.PhanTramKM FROM ChiTietKhuyenMai, KhuyenMai WHERE ChiTietKhuyenMai.MaKM = KhuyenMai.MaKM AND khuyenmai.TrangThai = 0 AND ChiTietKhuyenMai.MaApDung = ' . $item->MaSP . '');
            $x = 0;
            if ($check != null) {
                foreach ($check as $item1) {
                    if($item1->SoNgayDaApDung > -1 && $item1->SoNgayConLai <= 0){
                        $x += $item1->PhanTramKM;
                    }
                }
            }

            $x = $item->DonGia / 100 * (100 - $x);

            $arr = [
                'MaSP' => $data[$key]->MaSP,
                'TenSP' => $data[$key]->TenSP,
                'DonGia' => $data[$key]->DonGia,
                'SoLuong' => $data[$key]->SoLuong,
                'TenLoai' => $data[$key]->TenLoai,
                'TrangThai' => $data[$key]->TrangThai,
                'LoaiKichThuoc' => $data[$key]->LoaiKichThuoc,
                'TenDanhMuc' => $data[$key]->TenDanhMuc,
                'PhanTramKM' => $x,
                'TenAnh' => $data[$key]->TenAnh
            ];
            array_push($result, $arr);
        }
        return [$orders, $result];
    }

    public function changeOrderStatus($data)
    {
        $MaDH = $data['MaDH'];
        $trangthai = $data['TrangThai'];
        $TrangThaiCu = DB::select("SELECT TrangThai FROM donhang WHERE MaDH = $MaDH")[0]->TrangThai;
        $productInfo = DB::select("SELECT sanpham.SoLuong as soluongsp, chitietdonhang.SoLuong as soluong, sanpham.MaSP FROM sanpham, chitietdonhang, donhang WHERE sanpham.MaSP = chitietdonhang.MaSP AND donhang.MaDH = chitietdonhang.MaDH AND donhang.MaDH = $MaDH");
        if($TrangThaiCu != 5 && $TrangThaiCu != 6){
            foreach($productInfo as $item){
                $soluong = $item->soluongsp + $item->soluong;
                DB::select("UPDATE `sanpham` SET `SoLuong`='$soluong' WHERE MaSP = $item->MaSP");
            }
        }
        elseif($TrangThaiCu == 5 &&  $trangthai != 6 || $TrangThaiCu == 6 && $trangthai != 5 ){
            foreach($productInfo as $item){
                $soluong = $item->soluongsp - $item->soluong;
                DB::select("UPDATE `sanpham` SET `SoLuong`='$soluong' WHERE MaSP = $item->MaSP");
            }
        }

        DB::select("UPDATE `donhang` SET `TrangThai`='$trangthai' WHERE MaDH = $MaDH");
    }

    public function editOrder($data)
    {
        $hoten = $data['HoTen'];
        $diachi = $data['DiaChi'];
        $sodienthoai = $data['SoDienThoai'];
        $MaDH = $data['MaDH'];
        DB::select("DELETE FROM `chitietdonhang` WHERE MaDH = $MaDH");
        $arrId = explode("|", $data['MaSP']);
        array_pop($arrId);
        foreach ($arrId as $item) {
            $soluong = $data['SoLuong' . $item];
            if (isset($data['KichThuocNam' . $item]) && !isset($data['KichThuocNu' . $item])) {
                $kichthuoc = $data['KichThuocNam' . $item];
            } elseif (!isset($data['KichThuocNam' . $item]) && isset($data['KichThuocNu' . $item])) {
                $kichthuoc = $data['KichThuocNu' . $item];
            } elseif (isset($data['KichThuocNam' . $item]) && isset($data['KichThuocNu' . $item])) {
                $kichthuoc = $data['KichThuocNam' . $item] . "|" . $data['KichThuocNu' . $item];
            } else {
                $kichthuoc = "";
            }

            $dongia = $data['DonGia' . $item];

            DB::select("INSERT INTO `chitietdonhang`(`SoLuong`, `DonGia`, `KichThuoc`, `MaDH`, `MaSP`) VALUES ('$soluong','$dongia','$kichthuoc','$MaDH','$item')");
            $SoLuongSP = DB::select("SELECT SoLuong FROM sanpham WHERE MaSP = $item")[0]->SoLuong;
            // $soluong = $SoLuongSP - $soluong;
            // DB::select("UPDATE `sanpham` SET `SoLuong`='$soluong' WHERE MaSP = $item");
            echo "SoLuong = " . $soluong . " DonGia = " . $dongia . " KichThuoc = " . $kichthuoc;
            echo "<br>";
            DB::select("UPDATE `donhang` SET `TrangThai`='2' WHERE MaDH = $MaDH");

            DB::select("UPDATE `donhang` SET `DiaChi`='$diachi',`SoDienThoai`='$sodienthoai',`TenNguoiNhan`='$hoten' WHERE MaDH = $MaDH");
        }
    }

    public function sumOrder($year)
    {
        $arrSum = [];
        for ($j = 01; $j <= 12; $j++) {
            $month = str_pad($j, 2, '0', STR_PAD_LEFT);
            $sum = DB::select("SELECT SUM(chitietdonhang.DonGia*chitietdonhang.SoLuong) AS sum_price FROM donhang, chitietdonhang WHERE donhang.MaDH = chitietdonhang.MaDH AND donhang.TrangThai = 4 AND donhang.NgayDat LIKE '___" . $month . "_$year'")[0]->sum_price;
            if ($sum != null) {
                array_push($arrSum, [$sum]);
            } else {
                array_push($arrSum, [0]);
            }
        }

        $daySum = DB::select("SELECT SUM(chitietdonhang.DonGia*chitietdonhang.SoLuong) AS sum_price FROM donhang, chitietdonhang WHERE donhang.MaDH = chitietdonhang.MaDH AND donhang.TrangThai = 4 AND donhang.NgayDat LIKE '" . date("d/m/Y") . "'")[0]->sum_price;
        $yearSum = DB::select("SELECT SUM(chitietdonhang.DonGia*chitietdonhang.SoLuong) AS sum_price FROM donhang, chitietdonhang WHERE donhang.MaDH = chitietdonhang.MaDH AND donhang.TrangThai = 4 AND donhang.NgayDat LIKE '______" . date("Y") . "'")[0]->sum_price;
        $accountSum = DB::select("SELECT COUNT(*) AS count_account FROM taikhoan WHERE LoaiTK = 1")[0]->count_account;
        $orderSum = DB::select("SELECT COUNT(*) AS count_order FROM donhang WHERE TrangThai = 4")[0]->count_order;
        return [$arrSum, $daySum, $yearSum, $accountSum, $orderSum];
    }
}