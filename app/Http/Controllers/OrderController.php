<?php

namespace App\Http\Controllers;

use App\Models\order;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->order = new Order();
    }



    public function buyNow(Request $request)
    {
        if (isset(session()->all()['user'])) {
            // dd($request->all());

            if(isset($request->all()['KichThuocNam'])){
                $kichthuocnam = $request->all()['KichThuocNam'];
            }
            else{
                $kichthuocnam = 0;
            }

            if(isset($request->all()['KichThuocNu'])){
                $kichthuocnu = $request->all()['KichThuocNu'];
            }
            else{
                $kichthuocnu = 0;
            }
            
            $ProductInfo = $this->order->buyNow($request->all());
            $Address = $this->order->getAddress();
            $Quantity = $ProductInfo[0][0]->SoLuong;

            if (isset($request->all()['SoLuong'])) {
                $orderQuantity = $request->all()['SoLuong'];
            } else {
                $orderQuantity = 1;
            }

            return view('client/confirm_order', compact('ProductInfo', 'Address', 'Quantity', 'orderQuantity', 'kichthuocnam', 'kichthuocnu'));
        } else {
            return view('sign_in');
        }
    }

    public function addAddress(Request $request)
    {
        $this->order->addAddress($request->all());

        return redirect()->back()->withInput();
    }

    public function add_Address(Request $request)
    {
        $this->order->addAddress($request->all());

        ?>
            <script>
                sessionStorage.setItem("number", 1);
                history.back();
            </script>
        <?php
    }

    public function delete_Address()
    {
        $this->order->deleteAddress($_GET);
        ?>
            <script>
                sessionStorage.setItem("number", 1);
                history.back();
            </script>
        <?php

    }

    public function createBuyNowOrder(Request $request)
    {   
        $data = $request->all();
        session()->put('order', $data);

        if ($request->all()['pay1'] == 1) {
            return redirect('/donhang/thanhtoantructuyen');
        }
        if ($request->all()['pay1'] == 2) {
            $MaDH = $this->order->createBuyNowOrder($request->all());
            return redirect("/donhang/chitietdonhang?id=" . $MaDH . "");
        }
    }

    public function createByAllFromCart()
    {
        if (isset(session()->all()['user'])) {
            $orderInfo = $this->order->createByAllFromCart();
            $Address = $this->order->getAddress();
            return view('client.confirm_order_buyAll', compact('orderInfo', 'Address'));
        } else {
            return view('sign_in');
        }
    }

    public function changeQuantity()
    {
        $action = $_GET['action'];
        if ($action == 'increase') {
            $this->order->increaseQuantity($_GET);
        } elseif ($action == 'decrease') {
            $this->order->decreaseQuantity($_GET);
        }
        return redirect('/donhang/thanhtoangiohang');
    }

    public function createBuyAllOrder(Request $request)
    {
        if ($request->all()['pay1'] == 1) {
            $data = $request->all();
            session()->put('order', $data);
            return redirect('/donhang/thanhtoantructuyen');
        } elseif ($request->all()['pay1'] == 2) {
            session()->put('order', $request->all());
            $MaDH = $this->order->saveBuyAllOrder();
            return redirect("/donhang/chitietdonhang?id=" . $MaDH . "");
        }
    }

    public function orderDetail()
    {
        $orderId = $_GET['id'];
        $orderInfo = $this->order->orderDetail($orderId);
        return view('client.orderDetail', compact('orderInfo'));
    }

    public function saveBuyAllOrder()
    {
        $MaDH = $this->order->saveBuyAllOrder();
        return redirect("/donhang/chitietdonhang?id=" . $MaDH . "");
    }

    public function vn_pay()
    {
        $data = session()->get('order');
        $total = $data['TongCong'];

        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        /**
         * 
         *
         * @author CTT VNPAY
         */
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        /*
         * To change this license header, choose License Headers in Project Properties.
         * To change this template file, choose Tools | Templates
         * and open the template in the editor.
         */

        $vnp_TmnCode = "DR592SYB"; //Mã định danh merchant kết nối (Terminal Id)
        $vnp_HashSecret = "SBIOWLMODCTLMXKSPZHSZBTVGOATGYUQ"; //Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = url('donhang') . "/ketquathanhtoan";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        //Config input format
//Expire
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $vnp_TxnRef = rand(1, 10000); //Mã giao dịch thanh toán tham chiếu của merchant
        // if (isset($_POST['total']) && !isset($_POST['soluong']) && !isset($_POST['dongia'])) {
        //     $vnp_Amount = $_POST['total']; // Số tiền thanh toán
        // } elseif (isset($_POST['soluong']) && isset($_POST['dongia'])) {
        //     $vnp_Amount = $_POST['soluong'] * $_POST['dongia'];
        // }
        $vnp_Amount = $total;
        $vnp_Locale = 'vn'; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = 'VNBANK'; //Mã phương thức thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $expire
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        header('Location: ' . $vnp_Url);
        die();
    }

    public function vnPay_return()
    {
        session_start();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        /*
         * To change this license header, choose License Headers in Project Properties.
         * To change this template file, choose Tools | Templates
         * and open the template in the editor.
         */

        $vnp_TmnCode = "DR592SYB"; //Mã định danh merchant kết nối (Terminal Id)
        $vnp_HashSecret = "SBIOWLMODCTLMXKSPZHSZBTVGOATGYUQ"; //Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/thuongmaidientu/vnpay_php/vnpay_return.php";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";

        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == 00) {
                if (isset(session()->get('order')['locate'])) {
                    return redirect('/donhang/luuthanhtoan-tatca');
                } else {
                    return redirect('/donhang/luuthanhtoan-muangay');
                }
            } else {
                echo "<span style='color:red'>GD Khong thanh cong</span>";
            }
        } else {
            echo "<span style='color:red'>Chu ky khong hop le</span>";
        }
    }

    public function saveBuyNowOrder()
    {
        $MaDH = $this->order->saveBuyNowOrder();
        return redirect("/donhang/chitietdonhang?id=" . $MaDH . "");
    }

    public function orderList()
    {
        $userOrder = $this->order->selectUserorder();
        return view('client.order_list', compact('userOrder'));
    }

    public function exportPDF()
    {
        $userOrder = $this->order->selectUserorder();
        // return view('');
        $pdf = Pdf::loadView('client.exportPDF', compact('userOrder'));
        return $pdf->download('invoice.pdf');
    }
}