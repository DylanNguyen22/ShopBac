<?php

namespace App\Models\admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class admin extends Model
{
    use HasFactory;

    public function getAllUser(){
        $data = DB::select("SELECT * FROM taikhoan WHERE LoaiTK = 1");
        $arrUser = [];

        foreach($data as $item){
            array_push($arrUser, [
                'MaTK' => $item->MaTK,
                'Email' => $item->Email,
                'LoaiTK' => $item->LoaiTK,
                'TrangThai' => $item->TrangThai
            ]);
        }
        return $arrUser;
    }

    public function changeAccountStatus($id){
        $TrangThai = DB::select("SELECT TrangThai FROM taikhoan WHERE MaTK = $id")[0]->TrangThai;
        if($TrangThai == 1){
            DB::select("UPDATE `taikhoan` SET `TrangThai`='0' WHERE MaTK = $id");
        }else{
            DB::select("UPDATE `taikhoan` SET `TrangThai`='1' WHERE MaTK = $id");
        }
    }

    public function deleteUser($id){
        DB::select("DELETE FROM taikhoan WHERE MaTK = $id");
    }
}