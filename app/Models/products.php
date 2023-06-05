<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class products extends Model
{
    use HasFactory;

    public function getAllCategories()
    {
        $data = DB::select("SELECT * FROM DanhMuc WHERE TrangThai = 0");
        return $data;
    }

    public function getAllProductTypes()
    {
        $data = DB::select("SELECT * FROM LoaiSanPham WHERE trangThai = 0");
        return $data;
    }

    public function getMostSoldProduct()
    {
        $qr = DB::select("SELECT COUNT(sanpham.MaSP), sanpham.MaSP, SUM(chitietdonhang.SoLuong) as DaBan FROM sanpham, donhang, chitietdonhang WHERE sanpham.TrangThai = 0 AND sanpham.MaSP = chitietdonhang.MaSP AND donhang.MaDH = chitietdonhang.MaDH GROUP BY sanpham.MaSP ORDER BY DaBan DESC LIMIT 10");
        $result = [];
        foreach ($qr as $key => $item) {
            $data = DB::select("SELECT * FROM SanPham, HinhAnh, loaisanpham WHERE SanPham.MaSP = HinhAnh.MaSP AND loaisanpham.MaLoai = sanpham.MaLoai AND loaisanpham.TrangThai = 0 AND HinhAnh.LoaiAnh = 1 AND sanpham.MaSP = $item->MaSP")[0];
            $check = DB::select('SELECT DATEDIFF(NOW(), NgayBatDau) AS SoNgayDaApDung, DATEDIFF(NOW(), NgayHetHan) AS SoNgayConLai, khuyenmai.PhanTramKM FROM ChiTietKhuyenMai, KhuyenMai WHERE ChiTietKhuyenMai.MaKM = KhuyenMai.MaKM AND khuyenmai.TrangThai = 0 AND ChiTietKhuyenMai.MaApDung = ' . $item->MaSP . '');
            $x = 0;
            if ($check != null) {
                foreach ($check as $item1) {
                    if ($item1->SoNgayDaApDung > -1 && $item1->SoNgayConLai <= 0) {
                        $x += $item1->PhanTramKM;
                    }
                }
            }
            $x = $data->DonGia / 100 * (100 - $x);

            $arr = [
                'MaSP' => $data->MaSP,
                'MaTraCuu' => $data->MaTraCuu,
                'TenSP' => $data->TenSP,
                'DonGia' => $data->DonGia,
                'MoTa' => $data->MoTa,
                'ChiTiet' => $data->ChiTiet,
                'NgayLenKe' => $data->NgayLenKe,
                'Video' => $data->Video,
                'MaCL' => $data->MaCL,
                'SoLuong' => $data->SoLuong,
                'MaLoai' => $data->MaLoai,
                'PhanTramKM' => $x,
                'TenAnh' => $data->TenAnh
            ];
            array_push($result, $arr);
        }
        // echo "<pre>";
        //     print_r($result);
        // die();
        return $result;
    }

    public function getNewProduct()
    {
        $data = DB::select("SELECT * FROM SanPham, HinhAnh, loaisanpham WHERE sanpham.TrangThai = 0 AND SanPham.MaSP = HinhAnh.MaSP AND loaisanpham.MaLoai = sanpham.MaLoai AND loaisanpham.TrangThai = 0 AND HinhAnh.LoaiAnh = 1 ORDER BY sanpham.MaSP DESC LIMIT 10");
        $result = [];

        foreach ($data as $key => $item) {
            $check = DB::select('SELECT DATEDIFF(NOW(), NgayBatDau) AS SoNgayDaApDung, DATEDIFF(NOW(), NgayHetHan) AS SoNgayConLai, khuyenmai.PhanTramKM FROM ChiTietKhuyenMai, KhuyenMai WHERE ChiTietKhuyenMai.MaKM = KhuyenMai.MaKM AND khuyenmai.TrangThai = 0 AND ChiTietKhuyenMai.MaApDung = ' . $item->MaSP . '');
            $x = 0;
            if ($check != null) {
                foreach ($check as $item1) {
                    if ($item1->SoNgayDaApDung > -1 && $item1->SoNgayConLai <= 0) {
                        $x += $item1->PhanTramKM;
                    }
                }
            }
            $x = $item->DonGia / 100 * (100 - $x);

            $arr = [
                'MaSP' => $data[$key]->MaSP,
                'MaTraCuu' => $data[$key]->MaTraCuu,
                'TenSP' => $data[$key]->TenSP,
                'DonGia' => $data[$key]->DonGia,
                'MoTa' => $data[$key]->MoTa,
                'ChiTiet' => $data[$key]->ChiTiet,
                'NgayLenKe' => $data[$key]->NgayLenKe,
                'Video' => $data[$key]->Video,
                'MaCL' => $data[$key]->MaCL,
                'SoLuong' => $data[$key]->SoLuong,
                'MaLoai' => $data[$key]->MaLoai,
                'PhanTramKM' => $x,
                'TenAnh' => $data[$key]->TenAnh
            ];
            array_push($result, $arr);
        }
        return $result;
    }

    public function getAllProduct()
    {
        return DB::select("SELECT sanpham.MaSP, sanpham.TenSP, hinhanh.TenAnh FROM hinhanh, sanpham, loaisanpham WHERE sanpham.TrangThai = 0 AND sanpham.MaSP = hinhanh.MaSP AND sanpham.MaLoai = loaisanpham.MaLoai AND loaisanpham.trangThai = 0 AND hinhanh.LoaiAnh = 1");
    }

    public function search($keyword)
    {
        $data = DB::select("SELECT * FROM sanpham, hinhanh, loaisanpham WHERE sanpham.TrangThai = 0 AND sanpham.MaLoai = loaisanpham.MaLoai  AND loaisanpham.TrangThai = 0 AND hinhanh.MaSP = sanpham.MaSP AND hinhanh.LoaiAnh = 1 AND MATCH(sanpham.TenSP) AGAINST('$keyword' IN NATURAL LANGUAGE MODE)");
        // dd($data);
        $result = [];

        foreach ($data as $key => $item) {
            $check = DB::select('SELECT DATEDIFF(NOW(), NgayBatDau) AS SoNgayDaApDung, DATEDIFF(NOW(), NgayHetHan) AS SoNgayConLai, khuyenmai.PhanTramKM FROM ChiTietKhuyenMai, KhuyenMai WHERE ChiTietKhuyenMai.MaKM = KhuyenMai.MaKM AND khuyenmai.TrangThai = 0 AND ChiTietKhuyenMai.MaApDung = ' . $item->MaSP . '');
            $x = 0;
            if ($check != null) {
                foreach ($check as $item1) {
                    if ($item1->SoNgayDaApDung > -1 && $item1->SoNgayConLai <= 0) {
                        $x += $item1->PhanTramKM;
                    }
                }
            }

            $x = $item->DonGia / 100 * (100 - $x);

            $arr = [
                'MaSP' => $data[$key]->MaSP,
                'MaTraCuu' => $data[$key]->MaTraCuu,
                'TenSP' => $data[$key]->TenSP,
                'DonGia' => $data[$key]->DonGia,
                'MoTa' => $data[$key]->MoTa,
                'ChiTiet' => $data[$key]->ChiTiet,
                'NgayLenKe' => $data[$key]->NgayLenKe,
                'Video' => $data[$key]->Video,
                'MaCL' => $data[$key]->MaCL,
                'SoLuong' => $data[$key]->SoLuong,
                'MaLoai' => $data[$key]->MaLoai,
                'PhanTramKM' => $x,
                'TenAnh' => $data[$key]->TenAnh
            ];
            array_push($result, $arr);
        }
        return $result;
    }

    public function getProductByCategory($id)
    {
        $data = DB::select("SELECT * FROM sanpham, hinhanh, loaisanpham, danhmuc WHERE sanpham.MaLoai = loaisanpham.MaLoai AND loaisanpham.TrangThai = 0 AND sanpham.TrangThai = 0 AND hinhanh.MaSP = sanpham.MaSP AND hinhanh.LoaiAnh = 1 AND loaisanpham.MaDanhMuc = danhmuc.MaDanhMuc AND danhmuc.MaDanhMuc = $id");
        // dd($data);
        $result = [];

        foreach ($data as $key => $item) {
            $check = DB::select('SELECT DATEDIFF(NOW(), NgayBatDau) AS SoNgayDaApDung, DATEDIFF(NOW(), NgayHetHan) AS SoNgayConLai, khuyenmai.PhanTramKM FROM ChiTietKhuyenMai, KhuyenMai WHERE ChiTietKhuyenMai.MaKM = KhuyenMai.MaKM AND khuyenmai.TrangThai = 0 AND ChiTietKhuyenMai.MaApDung = ' . $item->MaSP . '');
            $x = 0;
            if ($check != null) {
                foreach ($check as $item1) {
                    if ($item1->SoNgayDaApDung > -1 && $item1->SoNgayConLai <= 0) {
                        $x += $item1->PhanTramKM;
                    }
                }
            }

            $x = $item->DonGia / 100 * (100 - $x);

            $arr = [
                'MaSP' => $data[$key]->MaSP,
                'MaTraCuu' => $data[$key]->MaTraCuu,
                'TenSP' => $data[$key]->TenSP,
                'DonGia' => $data[$key]->DonGia,
                'MoTa' => $data[$key]->MoTa,
                'ChiTiet' => $data[$key]->ChiTiet,
                'NgayLenKe' => $data[$key]->NgayLenKe,
                'Video' => $data[$key]->Video,
                'MaCL' => $data[$key]->MaCL,
                'SoLuong' => $data[$key]->SoLuong,
                'MaLoai' => $data[$key]->MaLoai,
                'PhanTramKM' => $x,
                'TenAnh' => $data[$key]->TenAnh
            ];
            array_push($result, $arr);
        }
        return $result;
    }
    public function getProductByType($id)
    {
        $data = DB::select("SELECT * FROM sanpham, hinhanh, loaisanpham WHERE sanpham.MaLoai = loaisanpham.MaLoai AND loaisanpham.TrangThai = 0 AND sanpham.TrangThai = 0 AND hinhanh.MaSP = sanpham.MaSP AND hinhanh.LoaiAnh = 1 AND loaisanpham.MaLoai = $id");
        $result = [];

        foreach ($data as $key => $item) {
            $check = DB::select('SELECT DATEDIFF(NOW(), NgayBatDau) AS SoNgayDaApDung, DATEDIFF(NOW(), NgayHetHan) AS SoNgayConLai, khuyenmai.PhanTramKM FROM ChiTietKhuyenMai, KhuyenMai WHERE ChiTietKhuyenMai.MaKM = KhuyenMai.MaKM AND khuyenmai.TrangThai = 0 AND ChiTietKhuyenMai.MaApDung = ' . $item->MaSP . '');
            $x = 0;
            if ($check != null) {
                foreach ($check as $item1) {
                    if ($item1->SoNgayDaApDung > -1 && $item1->SoNgayConLai <= 0) {
                        $x += $item1->PhanTramKM;
                    }
                }
            }

            $x = $item->DonGia / 100 * (100 - $x);

            $arr = [
                'MaSP' => $data[$key]->MaSP,
                'MaTraCuu' => $data[$key]->MaTraCuu,
                'TenSP' => $data[$key]->TenSP,
                'DonGia' => $data[$key]->DonGia,
                'MoTa' => $data[$key]->MoTa,
                'ChiTiet' => $data[$key]->ChiTiet,
                'NgayLenKe' => $data[$key]->NgayLenKe,
                'Video' => $data[$key]->Video,
                'MaCL' => $data[$key]->MaCL,
                'SoLuong' => $data[$key]->SoLuong,
                'MaLoai' => $data[$key]->MaLoai,
                'PhanTramKM' => $x,
                'TenAnh' => $data[$key]->TenAnh
            ];
            array_push($result, $arr);
        }
        return $result;
    }

    public function productDetail()
    {
        $MaSP = $_GET['id'];
        $imgs = DB::select("SELECT * FROM hinhanh WHERE MaSP = $MaSP");
        $product = DB::select("SELECT * FROM sanpham WHERE MaSP = $MaSP")[0];

        $check = DB::select('SELECT DATEDIFF(NOW(), NgayBatDau) AS SoNgayDaApDung, DATEDIFF(NOW(), NgayHetHan) AS SoNgayConLai, khuyenmai.PhanTramKM FROM ChiTietKhuyenMai, KhuyenMai WHERE ChiTietKhuyenMai.MaKM = KhuyenMai.MaKM AND khuyenmai.TrangThai = 0 AND ChiTietKhuyenMai.MaApDung = ' . $MaSP . '');
        $x = 0;
        if ($check != null) {
            foreach ($check as $item1) {
                if ($item1->SoNgayDaApDung > -1 && $item1->SoNgayConLai <= 0) {
                    $x += $item1->PhanTramKM;
                }
            }
        }

        $MaLoai = $product->MaLoai;

        $MaDM = DB::select("SELECT * FROM loaisanpham WHERE MaLoai = $MaLoai")[0]->MaDanhMuc;
        $data = DB::select("SELECT * FROM SanPham, HinhAnh, loaisanpham, danhmuc WHERE sanpham.TrangThai = 0 AND SanPham.MaSP = HinhAnh.MaSP AND loaisanpham.MaLoai = sanpham.MaLoai AND loaisanpham.TrangThai = 0 AND HinhAnh.LoaiAnh = 1 AND loaisanpham.MaDanhMuc = danhmuc.MaDanhMuc AND danhmuc.MaDanhMuc = $MaDM ORDER BY sanpham.MaSP DESC LIMIT 10");
        $result = [];

        foreach ($data as $key => $item) {
            $check = DB::select('SELECT DATEDIFF(NOW(), NgayBatDau) AS SoNgayDaApDung, DATEDIFF(NOW(), NgayHetHan) AS SoNgayConLai, khuyenmai.PhanTramKM FROM ChiTietKhuyenMai, KhuyenMai WHERE ChiTietKhuyenMai.MaKM = KhuyenMai.MaKM AND khuyenmai.TrangThai = 0 AND ChiTietKhuyenMai.MaApDung = ' . $item->MaSP . '');
            $y = 0;
            if ($check != null) {
                foreach ($check as $item1) {
                    if ($item1->SoNgayDaApDung > -1 && $item1->SoNgayConLai <= 0) {
                        $x += $item1->PhanTramKM;
                    }
                }
            }
            $y = $item->DonGia / 100 * (100 - $x);

            $arr = [
                'MaSP' => $data[$key]->MaSP,
                'MaTraCuu' => $data[$key]->MaTraCuu,
                'TenSP' => $data[$key]->TenSP,
                'DonGia' => $data[$key]->DonGia,
                'MoTa' => $data[$key]->MoTa,
                'ChiTiet' => $data[$key]->ChiTiet,
                'NgayLenKe' => $data[$key]->NgayLenKe,
                'Video' => $data[$key]->Video,
                'MaCL' => $data[$key]->MaCL,
                'SoLuong' => $data[$key]->SoLuong,
                'MaLoai' => $data[$key]->MaLoai,
                'PhanTramKM' => $y,
                'TenAnh' => $data[$key]->TenAnh
            ];
            array_push($result, $arr);
        }

        $material = DB::select("SELECT * FROM chatlieu WHERE MaCL = $product->MaCL")[0]->TenCL;
        return [$imgs, $product, $x, $material, $result];
    }
}