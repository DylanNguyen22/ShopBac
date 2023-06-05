<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class cart extends Model
{
    use HasFactory;

    public function addToCart($data)
    {
        if (isset(session()->all()['user'])) {
            $MaTK = session()->get('user');

            if (!empty($data)) {
                $MaSP = $data['ProductId'];
                $product = DB::select("SELECT * FROM SanPham WHERE MaSP = " . $MaSP . "");

                $ProductInfo = DB::select("SELECT * FROM ChiTietGioHang, GioHang WHERE ChiTietGioHang.MaSP=" . $MaSP . " AND GioHang.MaTK = " . $MaTK . " AND ChiTietGioHang.MaGH = GioHang.MaGH");
                if ($ProductInfo) {
                    if ($product[0]->SoLuong > $ProductInfo[0]->SoLuong) {
                        $MaSP = $ProductInfo[0]->MaSP;
                        $soluong = $ProductInfo[0]->SoLuong;
                        $check = DB::select("SELECT * FROM GioHang WHERE MaTK = " . $MaTK . "");
                        $MaGH = $check[0]->MaGH;
                        echo $MaSP;
                        DB::select("UPDATE `chitietgiohang` SET `SoLuong`= " . ++$soluong . " WHERE MaSP = " . $MaSP . " AND MaGH = " . $MaGH . "");
                    }
                } else {
                    $check = DB::select("SELECT * FROM GioHang WHERE MaTK = " . $MaTK . "");
                    if ($check) {
                        $MaGH = $check[0]->MaGH;
                    } else {
                        $MaGH = DB::table('GioHang')->insertGetId([
                            'MaTK' => session()->get('user')
                        ]);
                    }
                    $MaSP = $data['ProductId'];

                    DB::table('ChiTietGioHang')->insert([
                        'MaSP' => $MaSP,
                        'SoLuong' => 1,
                        'MaGH' => $MaGH
                    ]);
                }
            }

            if (isset(session()->all()['cart']) && !empty(session()->all()['cart'])) {
                foreach (session()->all()['cart'] as $item) {
                    $MaSP = $item['MaSanPham'];
                    $product = DB::select("SELECT * FROM SanPham WHERE MaSP = " . $MaSP . "");
                    $cart = DB::select("SELECT * FROM GioHang WHERE MaTK = " . $MaTK . "");
                    if ($cart != null) {
                        $MaGH = $cart[0]->MaGH;
                    } else {
                        $MaGH = DB::table('GioHang')->insertGetId([
                            'MaTK' => session()->get('user')
                        ]);
                    }
                    $cartDetailData = DB::select("SELECT * FROM ChiTietGioHang WHERE MaSP = " . $MaSP . " AND MaGH = " . $MaGH . "");
                    if ($cartDetailData) {
                        if ($item['SoLuong'] + $cartDetailData[0]->SoLuong > $product[0]->SoLuong) {
                            $soluong = $product[0]->SoLuong;
                            DB::select("UPDATE `chitietgiohang` SET `SoLuong`= $soluong WHERE MaGH = $MaGH AND MaSP = $MaSP");
                        } else {
                            $soluong = $item['SoLuong'] + $cartDetailData[0]->SoLuong;
                            DB::select("UPDATE `chitietgiohang` SET `SoLuong`= $soluong WHERE MaGH = $MaGH AND MaSP = $MaSP");
                        }
                    } else {
                        if ($item['SoLuong'] > $product[0]->SoLuong) {
                            $soluong = $product[0]->SoLuong;
                        } else {
                            $soluong = $item['SoLuong'];
                        }
                        DB::table('ChiTietGioHang')->insert([
                            'MaSP' => $MaSP,
                            'SoLuong' => $soluong,
                            'MaGH' => $MaGH
                        ]);
                    }
                }
            }
            if (isset(session()->all()['cart'])) {
                session()->forget('cart');
            }
            $MaTK = session()->get('user');
            $ProductInfo = DB::select("SELECT * FROM GioHang, SanPham, ChiTietGioHang, HinhAnh WHERE HinhAnh.MaSP = SanPham.MaSP AND HinhAnh.LoaiAnh = 1 AND GioHang.MaGH = ChiTietGioHang.MaGH AND SanPham.MaSP = ChiTietGioHang.MaSP AND GioHang.MaTK = " . $MaTK . "");
            return $ProductInfo;
        } else {
            // dd($data);
            $ProductId = $data['ProductId'];
            $Price = $data['Price'];

            $ProductInfo = DB::select("SELECT * FROM SanPham, HinhAnh WHERE SanPham.MaSP = HinhAnh.MaSP AND HinhAnh.LoaiAnh = 1 AND SanPham.MaSP = " . $ProductId . "");

            if (!session()->has('cart')) {
                session()->put('cart', []);
            }

            // Get the cart from the session
            $cart = session()->get('cart');

            // Check if the product is already in the cart
            $product = DB::select("SELECT * FROM SanPham WHERE MaSP = " . $ProductId . "");
            if (isset($cart[$ProductId])) {
                if ($product[0]->SoLuong > $cart[$ProductId]['SoLuong']) {
                    $product = DB::select("SELECT * FROM SanPham WHERE MaSP = " . $ProductId . "");
                    if ($product[0]->SoLuong > 0) {
                        $cart[$ProductId]['SoLuong'] += 1;
                    }
                }
            } else {
                if ($product[0]->SoLuong > 0) {
                    $cart[$ProductId] = [
                        'MaSanPham' => $ProductInfo[0]->MaSP,
                        'HinhAnh' => $ProductInfo[0]->TenAnh,
                        'TenSanPham' => $ProductInfo[0]->TenSP,
                        'DonGia' => $Price,
                        'SoLuong' => 1,
                        'ThanhTien' => $Price
                    ];
                }
            }

            session()->put('cart', $cart);

            $cart = session()->get('cart');
        }
    }
    public function getCart()
    {
        $MaTK = session()->get('user');
        $ProductInfo = DB::select("SELECT * FROM GioHang, SanPham, ChiTietGioHang, HinhAnh WHERE HinhAnh.MaSP = SanPham.MaSP AND HinhAnh.LoaiAnh = 1 AND GioHang.MaGH = ChiTietGioHang.MaGH AND SanPham.MaSP = ChiTietGioHang.MaSP AND GioHang.MaTK = " . $MaTK . "");
        return $ProductInfo;
    }

    //test k
    public function deleteFromCart($data)
    {
        if (isset(session()->all()['user'])) {
            $MaTK = session()->get('user');
            $MaSP = $data['ProductId'];
            $check = DB::select("SELECT * FROM GioHang WHERE MaTK = " . $MaTK . "");
            $MaGH = $check[0]->MaGH;
            DB::select("DELETE FROM `Chitietgiohang` WHERE MaSP = " . $MaSP . " AND MaGH = " . $MaGH . "");
        } else {
            $ProductId = $data['ProductId'];
            $cart = session()->get('cart');
            unset($cart[$ProductId]);
            session()->forget('cart');
            session()->put('cart', $cart);
        }
    }


    // test k ...

    public function update_cart_item_quantity($data)
    {
        $MaSP = $data[0];
        $MaTK = session()->get('user');
        if (isset(session()->all()['user'])) {
            if ($data[2] === "increase") {
                $product = DB::select("SELECT * FROM SanPham WHERE MaSP = " . $MaSP . "");
                $result = DB::select("SELECT * FROM ChiTietGioHang, GioHang WHERE ChiTietGioHang.MaSP = " . $MaSP . " AND GioHang.MaTK = " . $MaTK . " AND ChiTietGioHang.MaGH = GioHang.MaGH")[0];
                if ($product[0]->SoLuong > $result->SoLuong) {
                    $soluong = $result->SoLuong + 1;
                } else {
                    $soluong = $product[0]->SoLuong;
                }

                $check = DB::select("SELECT * FROM GioHang WHERE MaTK = " . $MaTK . "");
                $MaGH = $check[0]->MaGH;
                DB::select("UPDATE `chitietgiohang` SET `SoLuong`= " . $soluong . " WHERE MaSP = " . $MaSP . " AND MaGH = " . $MaGH . "");
            } elseif ($data[2] === "decrease") {
                $result = DB::select("SELECT * FROM ChiTietGioHang, GioHang WHERE ChiTietGioHang.MaSP = " . $MaSP . " AND GioHang.MaTK = " . $MaTK . " AND ChiTietGioHang.MaGH = GioHang.MaGH");
                if ($result[0]->SoLuong <= 1) {
                } else {
                    $result = DB::select("SELECT * FROM ChiTietGioHang, GioHang WHERE ChiTietGioHang.MaSP = " . $MaSP . " AND GioHang.MaTK = " . $MaTK . " AND ChiTietGioHang.MaGH = GioHang.MaGH");
                    $soluong = $result[0]->SoLuong;
                    $check = DB::select("SELECT * FROM GioHang WHERE MaTK = " . $MaTK . "");
                    $MaGH = $check[0]->MaGH;
                    DB::select("UPDATE `chitietgiohang` SET `SoLuong`= " . --$soluong . " WHERE MaSP = " . $MaSP . " AND MaGH = " . $MaGH . "");
                }
            }
        } else {

            // dd(session()->all());

            if ($data[2] === "increase") {
                $MaSP = $data[0];
                $product = DB::select("SELECT * FROM SanPham WHERE MaSP = " . $MaSP . "");
                $Cart = session()->all()['cart'][$MaSP];
                if ($Cart['SoLuong'] < $product[0]->SoLuong) {
                    $soluong = $Cart['SoLuong'] + 1;
                } else {
                    $soluong = $Cart['SoLuong'];
                }

                $cart_update = [
                    'MaSanPham' => $MaSP,
                    'HinhAnh' => $Cart['HinhAnh'],
                    'TenSanPham' => $Cart['TenSanPham'],
                    'DonGia' => $Cart['DonGia'],
                    'SoLuong' => $soluong,
                    'ThanhTien' => $Cart['DonGia'] * $Cart['SoLuong']
                ];


                // session()->forget('cart.1');
                session()->put("cart.$MaSP", $cart_update);

                // session()->forget('cart');


            } elseif ($data[2] === "decrease") {
                $MaSP = $data[0];
                $product = DB::select("SELECT * FROM SanPham WHERE MaSP = " . $MaSP . "");
                $Cart = session()->all()['cart'][$MaSP];
                if ($Cart['SoLuong'] > 1) {
                    $soluong = $Cart['SoLuong'] - 1;
                } else {
                    $soluong = $Cart['SoLuong'];
                }

                $cart_update = [
                    'MaSanPham' => $MaSP,
                    'HinhAnh' => $Cart['HinhAnh'],
                    'TenSanPham' => $Cart['TenSanPham'],
                    'DonGia' => $Cart['DonGia'],
                    'SoLuong' => $soluong,
                    'ThanhTien' => $Cart['DonGia'] * $Cart['SoLuong']
                ];


                // session()->forget('cart.1');
                session()->put("cart.$MaSP", $cart_update);
                //
            }
        }
    }


}