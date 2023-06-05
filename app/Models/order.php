<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class order extends Model
{
    use HasFactory;

    public function buyNow($data)
    {
        $GiaTien = $data['GiaTien'];
        $MaSP = $data['MaSP'];
        $data = DB::select("SELECT * FROM SanPham, HinhAnh WHERE SanPham.MaSP = HinhAnh.MaSP AND HinhAnh.LoaiAnh = 1 AND sanpham.MaSP = $MaSP");

        return [
            $data,
            $GiaTien,
        ];
    }

    public function addAddress($data)
    {
        // dd($data);
        $MaTK = session()->get('user');
        $diachi = $data['sonha/duong'] . ", " . $data['phuong/xa'] . ", " . $data['quan/huyen'] . ", " . $data['tinh/thanh'];
        DB::table('DiaChi')->insert([
            'DiaChi' => $diachi,
            'SoDienThoai' => $data['SDT'],
            'HoVaTen' => $data['Ho'] . " " . $data['Ten'],
            'MaTK' => $MaTK
        ]);
    }

    public function getAddress()
    {
        $MaTK = session()->get('user');
        $data = DB::select("SELECT * FROM DiaChi WHERE MaTK = $MaTK");
        return $data;
    }

    public function deleteAddress($data)
    {
        $MaDC = $data['id'];
        $MaTK = session()->get('user');
        DB::select("DELETE FROM `diachi` WHERE MaDC = $MaDC AND MaTK = $MaTK");
    }

    public function createBuyNowOrder($data)
    {
        $arr = explode("|", $data['address1']);

        $MaTK = session()->get('user');
        $soluong = $data['SoLuong'];
        $dongia = $data['DonGia'];
        $MaSP = $data['MaSP'];
        $diachi = $arr[0];
        $sodienthoai = $arr[1];
        $tennguoinhan = $arr[2];
        if (isset($data['KichThuocNam']) && !isset($data['KichThuocNu'])) {
            $kichthuoc = $data['KichThuocNam'];
        }
        if (!isset($data['KichThuocNam']) && isset($data['KichThuocNu'])) {
            $kichthuoc = $data['KichThuocNu'];
        }
        if (isset($data['KichThuocNam']) && isset($data['KichThuocNu'])) {
            $kichthuoc = $data['KichThuocNam'] . "|" . $data['KichThuocNu'];
        } else {
            $kichthuoc = 0;
        }
        // dd($kichthuoc);
        $MaDH = DB::table('DonHang')->insertGetId([
            'NgayDat' => date('d/m/Y'),
            'DiaChi' => $diachi,
            'SoDienThoai' => $sodienthoai,
            'TenNguoiNhan' => $tennguoinhan,
            'GhiChu' => '',
            'TrangThai' => 1,
            'LoaiThanhToan' => 1,
            'MaTK' => $MaTK
        ]);

        DB::table('ChiTietDonHang')->insert([
            'SoLuong' => $soluong,
            'DonGia' => $dongia,
            'KichThuoc' => $kichthuoc,
            'MaDH' => $MaDH,
            'MaSP' => $MaSP
        ]);

        $soluongsanpham = DB::select("SELECT SoLuong FROM sanpham WHERE MaSP = $MaSP")[0]->SoLuong;
        $soluong = $soluongsanpham - $soluong;
        DB::select("UPDATE `sanpham` SET `SoLuong`='$soluong' WHERE MaSP = $MaSP");
        $MaGH = DB::select("SELECT MaGH FROM giohang WHERE MaTK = $MaTK")[0]->MaGH;
        DB::select("DELETE FROM `chitietgiohang` WHERE MaSP = $MaSP AND MaGH = $MaGH");
        return $MaDH;
    }

    public function createByAllFromCart()
    {
        $MaTK = session()->get('user');
        $product = DB::select("SELECT sanpham.MaSP, sanpham.LoaiKichThuoc, hinhanh.TenAnh, sanpham.TenSP, sanpham.DonGia, chitietgiohang.SoLuong, sanpham.SoLuong as SoLuongSP FROM hinhanh, sanpham, chitietgiohang, giohang WHERE chitietgiohang.MaSP = sanpham.MaSP AND giohang.MaGH = chitietgiohang.MaGH AND giohang.MaTK = $MaTK AND sanpham.MaSP = hinhanh.MaSP AND hinhanh.LoaiAnh = '1';");
        // dd($product);
        return $product;
    }

    public function orderDetail($orderId)
    {
        $result = DB::select("SELECT donhang.NgayDat, donhang.DiaChi, donhang.SoDienThoai, donhang.TenNguoiNhan, donhang.GhiChu, donhang.TrangThai, donhang.LoaiThanhToan, chitietdonhang.SoLuong, chitietdonhang.DonGia, sanpham.TenSP, sanpham.MaTraCuu, chitietdonhang.KichThuoc, sanpham.LoaiKichThuoc FROM sanpham, donhang, chitietdonhang WHERE donhang.MaDH = chitietdonhang.MaDH AND donhang.MaDH = $orderId AND sanpham.MaSP = chitietdonhang.MaSP");
        return $result;
    }

    public function saveBuyNowOrder()
    {
        $data = session()->get('order');

        $arr = explode("|", $data['address1']);

        $MaTK = session()->get('user');
        $soluong = $data['SoLuong'];
        $dongia = $data['DonGia'];
        $MaSP = $data['MaSP'];
        $diachi = $arr[0];
        $sodienthoai = $arr[1];
        $tennguoinhan = $arr[2];

        if (isset($data['KichThuocNam']) && !isset($data['KichThuocNu'])) {
            $kichthuoc = $data['KichThuocNam'];
        }
        if (!isset($data['KichThuocNam']) && isset($data['KichThuocNu'])) {
            $kichthuoc = $data['KichThuocNu'];
        }
        if (isset($data['KichThuocNam']) && isset($data['KichThuocNu'])) {
            $kichthuoc = $data['KichThuocNam'] . "|" . $data['KichThuocNu'];
        } else {
            $kichthuoc = 0;
        }

        $MaDH = DB::table('DonHang')->insertGetId([
            'NgayDat' => date('d/m/Y'),
            'DiaChi' => $diachi,
            'SoDienThoai' => $sodienthoai,
            'TenNguoiNhan' => $tennguoinhan,
            'GhiChu' => '',
            'TrangThai' => 1,
            'LoaiThanhToan' => 2,
            'MaTK' => $MaTK
        ]);

        DB::table('ChiTietDonHang')->insert([
            'SoLuong' => $soluong,
            'DonGia' => $dongia,
            'KichThuoc' => $kichthuoc,
            'MaDH' => $MaDH,
            'MaSP' => $MaSP
        ]);

        $soluongsanpham = DB::select("SELECT SoLuong FROM sanpham WHERE MaSP = $MaSP")[0]->SoLuong;
        $soluong = $soluongsanpham - $soluong;
        DB::select("UPDATE `sanpham` SET `SoLuong`='$soluong' WHERE MaSP = $MaSP");
        $MaGH = DB::select("SELECT MaGH FROM giohang WHERE MaTK = $MaTK")[0]->MaGH;
        DB::select("DELETE FROM `chitietgiohang` WHERE MaSP = $MaSP AND MaGH = $MaGH");
        return $MaDH;
    }

    public function increaseQuantity($data)
    {
        $MaSP = $data['id'];
        $soluongSP = DB::select("SELECT * FROM sanpham WHERE MaSP = $MaSP")[0]->SoLuong;
        $soluong = DB::select("SELECT * FROM chitietgiohang WHERE MaSP = $MaSP")[0]->SoLuong;
        if ($soluong < $soluongSP) {
            ++$soluong;
            DB::select("UPDATE `chitietgiohang` SET `SoLuong`= $soluong WHERE MaSP = $MaSP");
        }
    }

    public function decreaseQuantity($data)
    {
        $MaSP = $data['id'];
        $soluong = DB::select("SELECT * FROM chitietgiohang WHERE MaSP = $MaSP")[0]->SoLuong;
        if ($soluong > 1) {
            --$soluong;
            DB::select("UPDATE `chitietgiohang` SET `SoLuong`= $soluong WHERE MaSP = $MaSP");
        }
    }

    public function saveBuyAllOrder()
    {
        $data = session()->get('order');
        // dd($data);  
        $arr = explode("|", $data['address1']);

        $MaTK = session()->get('user');
        $diachi = $arr[0];
        $sodienthoai = $arr[1];
        $tennguoinhan = $arr[2];

        if (isset($data['KichThuocNam']) && !isset($data['KichThuocNu'])) {
            $kichthuoc = $data['KichThuocNam'];
        } elseif (!isset($data['KichThuocNam']) && isset($data['KichThuocNu'])) {
            $kichthuoc = $data['KichThuocNu'];
        } elseif (isset($data['KichThuocNam']) && isset($data['KichThuocNu'])) {
            $kichthuoc = $data['KichThuocNam'] . "|" . $data['KichThuocNu'];
        } else {
            $kichthuoc = 0;
        }

        if ($data['pay1'] == 1) {
            $loaithanhtoan = 1;
        } elseif ($data['pay1'] == 2) {
            $loaithanhtoan = 2;
        }


        $MaDH = DB::table('DonHang')->insertGetId([
            'NgayDat' => date('d/m/Y'),
            'DiaChi' => $diachi,
            'SoDienThoai' => $sodienthoai,
            'TenNguoiNhan' => $tennguoinhan,
            'GhiChu' => '',
            'TrangThai' => 1,
            'LoaiThanhToan' => $loaithanhtoan,
            'MaTK' => $MaTK
        ]);

        $arr1 = explode("|", $data['Product_info']);
        array_pop($arr1);
        $sizeArr = "";
        for ($i = 0; $i <= count($arr1); $i++) {
            if (isset($data['KichThuocNam' . $i]) && !isset($data['KichThuocNu' . $i])) {
                $sizeArr .= $data['KichThuocNam' . $i] . "-";
            } elseif (!isset($data['KichThuocNam' . $i]) && isset($data['KichThuocNu' . $i])) {
                $sizeArr .= $data['KichThuocNu' . $i] . "-";
            } elseif (isset($data['KichThuocNam' . $i]) && isset($data['KichThuocNu' . $i])) {
                $sizeArr .= $data['KichThuocNam' . $i] . "|" . $data['KichThuocNu' . $i] . "-";
            } else {
                $sizeArr .= "0-";
            }
        }
        $sizeArr = explode("-", $sizeArr);
        array_pop($sizeArr);
        array_pop($sizeArr);

        foreach ($arr1 as $key => $item) {
            $arr2 = explode("-", $item);
            $MaSP = $arr2[0];
            $soluong = $arr2[2];
            DB::table('ChiTietDonHang')->insert([
                'SoLuong' => $arr2[2],
                'DonGia' => $arr2[1],
                'KichThuoc' => $sizeArr[$key],
                'MaDH' => $MaDH,
                'MaSP' => $arr2[0]
            ]);

            $soluongsanpham = DB::select("SELECT SoLuong FROM sanpham WHERE MaSP = $MaSP")[0]->SoLuong;
            $soluong = $soluongsanpham - $soluong;
            DB::select("UPDATE `sanpham` SET `SoLuong`='$soluong' WHERE MaSP = $MaSP");
            $MaGH = DB::select("SELECT MaGH FROM giohang WHERE MaTK = $MaTK")[0]->MaGH;
            DB::select("DELETE FROM `chitietgiohang` WHERE MaSP = $MaSP AND MaGH = $MaGH");
        }

        DB::select("DELETE FROM `giohang` WHERE MaTK = $MaTK");

        return $MaDH;
    }

    public function selectUserorder()
    {
        $MaTK = session()->get('user');
        $order = DB::select("SELECT * FROM `donhang` WHERE MaTK = $MaTK ORDER BY MaDH DESC");
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
                $item->MaDH
            ]);
        }
        return $arr1;
    }
}