<?php

namespace App\Models\admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class admin_category_productType extends Model
{
    use HasFactory;
    
    public function getAllCategory(){
        return DB::select("SELECT * FROM danhmuc");
    }

    public function getAllCategoryAndType(){
        $category = DB::select("SELECT * FROM danhmuc");
        $list = [];
        foreach($category as $item){
            $arr2 = [];
            $arrType = [];
            $arrCategory = [
                $item->MaDanhMuc,
                $item->TenDanhMuc,
                $item->TrangThai
            ];
            
            $type = DB::select("SELECT * FROM loaisanpham WHERE MaDanhMuc = $item->MaDanhMuc");
            foreach($type as $item1){
                $arr = [
                    $item1->MaLoai,
                    $item1->TenLoai,
                    $item1->TrangThai,
                    $item1->MaDanhMuc
                ];

                array_push($arr2, $arr);
            }
            array_push($arrType, $arr2);
            array_push($arrCategory, $arrType);
            array_push($list, $arrCategory);

        }
        // dd($list);
        return $list;
    }

    public function changeCategoryStatus($id){
        $data = DB::select("SELECT danhmuc.TrangThai FROM danhmuc WHERE MaDanhMuc = $id");
        if($data[0]->TrangThai == 0){
            DB::select("UPDATE `danhmuc` SET `TrangThai`= 1 WHERE MaDanhMuc = $id");
            DB::select("UPDATE `loaisanpham` SET `TrangThai`= 1 WHERE MaDanhMuc = $id");
            $product = DB::select("SELECT MaLoai FROM loaisanpham WHERE MaDanhMuc = $id");
            foreach($product as $item){
                $maloai = $item->MaLoai;
                DB::select("UPDATE `sanpham` SET `TrangThai`= 1 WHERE MaLoai = $maloai");
            }
        }else{
            DB::select("UPDATE `danhmuc` SET `TrangThai`= 0 WHERE MaDanhMuc = $id");
            DB::select("UPDATE `loaisanpham` SET `TrangThai`= 0 WHERE MaDanhMuc = $id");
            $product = DB::select("SELECT MaLoai FROM loaisanpham WHERE MaDanhMuc = $id");
            foreach($product as $item){
                $maloai = $item->MaLoai;
                DB::select("UPDATE `sanpham` SET `TrangThai`= 0 WHERE MaLoai = $maloai");
            }
        }
    }
    public function changeCategoryName($data){
        $tendanhmuc = $data['tendanhmuc'];
        $madanhmuc = $data['madanhmuc'];
        DB::select("UPDATE `danhmuc` SET `TenDanhMuc` = '$tendanhmuc' WHERE MaDanhMuc = $madanhmuc");
    }

    public function addCategory($data){
        $tendanhmuc = $data['tendanhmuc'];
        DB::select("INSERT INTO `danhmuc`(`TenDanhMuc`, `TrangThai`) VALUES ('$tendanhmuc', 0)");
    }

    public function deleteCategory($data){
        $madanhmuc = $data['MaDanhMuc'];
        DB::select("DELETE FROM `danhmuc` WHERE MaDanhMuc = $madanhmuc");
    }

    public function addProductType($data){
        $madanhmuc = $data['madanhmuc'];
        $tenloai = $data['tenloai'];
        
        DB::select("INSERT INTO `loaisanpham`(`TenLoai`, `TrangThai`, `MaDanhMuc`) VALUES ('$tenloai',0 , $madanhmuc)");
    }

    public function changeProductTypeStatus($id){
        $data = DB::select("SELECT * FROM loaisanpham WHERE MaLoai = $id");
        $MaLoai = $data[0]->MaLoai;
        if($data[0]->TrangThai == 0){
            DB::select("UPDATE `loaisanpham` SET `TrangThai`= 1 WHERE MaLoai = $MaLoai");
            DB::select("UPDATE `sanpham` SET `TrangThai`= 1 WHERE MaLoai = $MaLoai");
        }else{
            DB::select("UPDATE `loaisanpham` SET `TrangThai`= 0 WHERE MaLoai = $MaLoai");
            DB::select("UPDATE `sanpham` SET `TrangThai`= 0 WHERE MaLoai = $MaLoai");
        }
    }

    public function editProductType($data){
        $tenloai = $data['tenloai'];
        $madanhmuc = $data['madanhmuc'];
        $maloai = $data['maloai'];
        DB::select("UPDATE `loaisanpham` SET `TenLoai`='$tenloai', `MaDanhMuc`='$madanhmuc' WHERE MaLoai = $maloai");
    }

    public function deleteProductType($maloai){
        DB::select("DELETE FROM `loaisanpham` WHERE MaLoai = $maloai");
    }

}
