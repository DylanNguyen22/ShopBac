<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class auth extends Model
{
    use HasFactory;

    public function sign_up($data)
    {
        $email = $data['Email'];
        $hashed = Hash::make($data['Password']);

        DB::table('TaiKhoan')->insert([
            'Email' => $email,
            'MatKhau' => $hashed,
            'LoaiTK' => '1',
            'TrangThai' => '0'
        ]);
    }

    public function sign_in($data)
    {

        $user = DB::select('SELECT * FROM taikhoan WHERE Email = ?', [$data['Email']]);

        if (!empty($user)) {
            $pass = $user[0]->MatKhau;
            if (Hash::check($data['Password'], $pass)) {
                if ($user[0]->TrangThai != 0) {
                    $msg = 'bị khóa';
                    return $msg;
                } else {
                    if ($user[0]->LoaiTK == 1) {
                        $msg = [$user[0]->MaTK, "customer"];
                        return $msg;
                    } elseif ($user[0]->LoaiTK == 2) {
                        $msg = [$user[0]->MaTK, "admin"];
                        return $msg;
                    }
                }
            } else {
                $msg = 'sai mk';
                return $msg;
            }
        } else {
            $msg = 'sai tk';
            return $msg;
        }
    }
}