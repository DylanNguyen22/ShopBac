<?php
namespace App\Http\Controllers;

use App\Models\auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class authController extends Controller
{
    public function __construct()
    {
        $this->auth = new auth();
    }

    public function sign_up()
    {
        return view('sign_up');
    }

    public function sign_in()
    {
        return view('sign_in');
    }

    public function handle_sign_up(Request $request)
    {
        $request->validate([
            'Email' => 'required | email',
            'Password' => 'min:8 | max:16',
            'Re_password' => 'min:8 | max:16'
        ], [
                'Email.required' => 'Vui lòng nhập email',
                'Email.email' => 'Email không đúng định dạng',
                'Password.min' => 'Vui lòng nhập mật khẩu có độ dài từ 8 đến 16 kí tự',
                'Password.max' => 'Vui lòng nhập mật khẩu có độ dài từ 8 đến 16 kí tự',
                'Re_password.min' => 'Vui lòng nhập lại mật khẩu có độ dài từ 8 đến 16 kí tự',
                'Re_password.max' => 'Vui lòng nhập lại mật khẩu có độ dài từ 8 đến 16 kí tự'
            ]);

        $this->auth->sign_up($request->all());
        return redirect('/dangnhap');
    }

    public function handle_sign_in(Request $request)
    {
        $request->validate([
            'Email' => 'required | email',
            'Password' => 'min:8 | max:16',
        ], [
                'Email.required' => 'Vui lòng nhập email',
                'Email.email' => 'Email không đúng định dạng',
                'Password.min' => 'Vui lòng nhập mật khẩu có độ dài từ 8 đến 16 kí tự',
                'Password.max' => 'Vui lòng nhập mật khẩu có độ dài từ 8 đến 16 kí tự'
            ]);

        $msg = $this->auth->sign_in($request->all());
        // echo $msg;
        if ($msg[0] == 'sai tk') {
            $error1 = "Tài khoản không tồn tại, vui lòng kiểm tra lại thông tin!";
            $email = $request->all()['Email'];
            return view('sign_in', compact('error1', 'email'));
        }
        if ($msg[0] == 'sai mk') {
            $error2 = "Mật khẩu sai, vui lòng kiểm tra lại!";
            $email = $request->all()['Email'];
            return view('sign_in', compact('error2', 'email'));
        }
        if ($msg[0] != 'sai tk' && $msg[0] != 'sai mk') {
            if ($msg === "bị khóa") {
                $error1 = "Có gì đó không đúng, vui lòng thử lại bằng tài khoản khác !";
                $email = $request->all()['Email'];
                return view('sign_in', compact('error1', 'email'));
            } else {
                if ($msg[1] == "admin") {
                    Session::put('user', $msg[0]);
                    Session::put('role', $msg[1]);
                    return redirect('/admin')->with('session');
                }
                else{
                    Session::put('user', $msg[0]);
                    Session::put('role', $msg[1]);
                    return redirect('/admin')->with('session');
                }
            }
        }
    }

    public function sign_out(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}