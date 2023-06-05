<?php

namespace App\Models\admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class admin_product extends Model
{
    use HasFactory;

    public function getAllProduct()
    {
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
        return $result;
        // return array($data, $discount);
    }

    public function editProduct($MaSP)
    {
        $data = DB::select("SELECT sanpham.MaSP, sanpham.MoTa, sanpham.ChiTiet, sanpham.MaCL, sanpham.MaTraCuu, sanpham.TenSP, hinhanh.TenAnh, sanpham.TrangThai, sanpham.Video, sanpham.DonGia, sanpham.LoaiKichThuoc, sanpham.SoLuong, loaisanpham.TenLoai, loaisanpham.MaLoai, danhmuc.TenDanhMuc FROM sanpham, hinhanh, danhmuc, loaisanpham WHERE sanpham.MaLoai = loaisanpham.MaLoai AND sanpham.MaSP = hinhanh.MaSP AND danhmuc.MaDanhMuc = loaisanpham.MaDanhMuc AND hinhanh.LoaiAnh = 1 AND sanpham.MaSP = $MaSP");
        return $data;
    }

    public function deleteProduct($id){
        // Storage::delete("public/product_imgs/20230525020531.jpg");
        
        $imgs = DB::select("SELECT * FROM hinhanh WHERE MaSP = $id");
        foreach($imgs as $item){
            // dd('public/product_imgs/'.$item->TenAnh);
            Storage::delete('public/product_imgs/'.$item->TenAnh);
        }

        DB::select("DELETE FROM `sanpham` WHERE MaSP = $id");
    }

    public function getAllProductTypes()
    {
        $data = DB::select("SELECT * FROM loaisanpham");
        return $data;
    }

    public function getAllProductImage($MaSP)
    {
        $data = DB::select("SELECT * FROM hinhanh WHERE MaSP = $MaSP");
        return $data;
    }

    public function getAllMaterial()
    {
        $data = DB::select("SELECT * FROM chatlieu");
        return $data;
    }

    public function handleAddProduct($data)
    {
        $MaTraCuu = $data->all()['MaTraCuu'];
        $TenSp = $data->all()['TenSP'];
        $DonGia = $data->all()['DonGia'];
        $MoTa = $data->all()['MoTa'];
        $NgayLenKe = date('Y-m-d');
        $MaCL = $data->all()['ChatLieu'];
        $MaLoai = $data->all()['MaLoai'];
        $ChiTiet = $data->all()['ChiTiet'];
        $SoLuong = $data->all()['SoLuong'];
        $loaikichthuoc = $data->all()['LoaiKichThuoc'];
        if ($data->all()['Video'] != null) {
            $Video = $data->all()['Video'];
        } else {
            $Video = '';
        }


        $images = $data->file('AnhSP');

        $MaSP = DB::table('SanPham')->insertGetId([
            'MaTraCuu' => $MaTraCuu,
            'TenSP' => $TenSp,
            'DonGia' => $DonGia,
            'MoTa' => $MoTa,
            'ChiTiet' => $ChiTiet,
            'NgayLenKe' => $NgayLenKe,
            'Video' => $Video,
            'SoLuong' => $SoLuong,
            'LoaiKichThuoc' => $loaikichthuoc,
            'TrangThai' => 0,
            'MaCL' => $MaCL,
            'MaLoai' => $MaLoai,
        ]);

        foreach ($images as $key => $image) {
            $image->storeAs('/public/product_imgs', date('Ymdhms') . $key . '.jpg', 'local');
            DB::table('HinhAnh')->insert([
                'LoaiAnh' => 0,
                'TenAnh' => date('Ymdhms') . $key . '.jpg',
                'MaSP' => $MaSP
            ]);
        }
        $data->file('AnhBia')->storeAs('/public/product_imgs', date('Ymdhms') . '.jpg', 'local');
        DB::table('HinhAnh')->insert([
            'LoaiAnh' => 1,
            'TenAnh' => date('Ymdhms') . '.jpg',
            'MaSP' => $MaSP
        ]);
    }

    public function changeProductStatus($id){
        $status = DB::select("SELECT sanpham.TrangThai FROM sanpham WHERE MaSP = $id");
        if($status[0]->TrangThai == 0){
            DB::select("UPDATE `sanpham` SET `TrangThai`='1' WHERE MaSP = $id");
        }else{
            DB::select("UPDATE `sanpham` SET `TrangThai`='0' WHERE MaSP = $id");
        }
    }

    public function handleEditProduct($data)
    {
        // dd($data->all());
        $matracuu = $data->all()['MaTraCuu'];
        $tensp = $data->all()['TenSP'];
        $dongia = $data->all()['DonGia'];
        $mota = $data->all()['MoTa'];
        $chitiet = $data->all()['ChiTiet'];
        $video = $data->all()['Video'];
        $soluong = $data->all()['SoLuong'];
        $loaikichthuoc = $data->all()['LoaiKichThuoc'];
        $trangthai = $data->all()['TrangThai'];
        $maloai = $data->all()['MaLoai'];
        $macl = $data->all()['ChatLieu'];
        $masp = $data->all()['MaSP'];
        DB::select("UPDATE `sanpham` SET `MaTraCuu`='$matracuu',`TenSP`='$tensp',`DonGia`=$dongia,`MoTa`='$mota',`ChiTiet`='$chitiet',`Video`='$video',`SoLuong`=$soluong,`LoaiKichThuoc`=$loaikichthuoc,`TrangThai`=$trangthai,`MaCL`=$macl,`MaLoai`='$maloai' WHERE MaSP = $masp");

        $thumb_1 = DB::select("SELECT * FROM hinhanh WHERE MaSP = $masp AND LoaiAnh = 1");
        if ($data['AnhBia'] != null) {
            Storage::delete('/public/product_imgs/' . $thumb_1[0]->TenAnh);
            DB::select("DELETE FROM `hinhanh` WHERE MaHA = " . $thumb_1[0]->MaHA . "");
            $data->file('AnhBia')->storeAs('/public/product_imgs', date('Ymdhms') . '.jpg', 'local');
            DB::table('HinhAnh')->insert([
                'LoaiAnh' => 1,
                'TenAnh' => date('Ymdhms') . '.jpg',
                'MaSP' => $masp
            ]);
        }
        if ($data->file('AnhSP') != null) {
            $thumb_0 = DB::select("SELECT * FROM hinhanh WHERE MaSP = $masp AND LoaiAnh = 0");
            foreach ($thumb_0 as $item) {
                Storage::delete('/public/product_imgs/' . $item->TenAnh);
                DB::select("DELETE FROM `hinhanh` WHERE MaHA = $item->MaHA");
            }
            $images = $data->file('AnhSP');
            foreach ($images as $key => $image) {
                $image->storeAs('/public/product_imgs', date('Ymdhms') . $key . '.jpg', 'local');
                DB::table('HinhAnh')->insert([
                    'LoaiAnh' => 0,
                    'TenAnh' => date('Ymdhms') . $key . '.jpg',
                    'MaSP' => $masp
                ]);
            }
        }
    }
}