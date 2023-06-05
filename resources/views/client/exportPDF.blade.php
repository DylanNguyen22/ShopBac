<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Hello  { { data['name'] } }
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>




















{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    @font-face {
        font-family: 'Journal';
        src: url('yourwebsite.com/journal.ttf")}}') format('truetype');
    }

    * {
        font-family: 'Journal';
    }

    h1,
    h2 {
        margin: 0;
        font-weight: 400;
    }

    .container {
        margin: 0 30px 0 30px
    }
</style>

<body>
    <div class="container">
        <div class="header">
            <div style="display: flex; flex-direction: column; align-items: end" class="">
                <h1 style="margin: 0"><b>HÓA ĐƠN</b></h1>
                <h1 style="font-weight: 500; color: rgb(93, 93, 93); margin: 0"><span>05/01/2023</span></h1>
            </div>
            <div class="" style="display: flex; justify-content: space-around">
                <div class="">
                    <h1><b>Địa chỉ nhận hàng</b></h1>
                    <h1><span>Nguyễn Thiên Định</span></h1>
                    <h1><span>0854243828</span></h1>
                    <h1><span>Ấp Trung Xinh, Đông Thái, An Biên, Kiên Giang</span></h1>
                </div>
                <div class="">
                    <h1><b>Địa chỉ thanh toán</b></h1>
                    <h1><span>Nguyễn Thiên Định</span></h1>
                    <h1><span>0854243828</span></h1>
                    <h1><span>Ấp Trung Xinh, Đông Thái, An Biên, Kiên Giang</span></h1>
                </div>
            </div>
        </div>
        <div class="" style="margin-top: 35px">
            <table style="border: 2px solid black; width: 100%; border-spacing: 0">
                <thead>
                    <tr style="background: rgb(240 240 240);">
                        <th>
                            <h1><b>Số hóa đơn</b></h1>
                        </th>
                        <th>
                            <h1><b>Hóa đơn ngày</b></h1>
                        </th>
                        <th>
                            <h1><b>Tham chiếu đơn hàng</b></h1>
                        </th>
                        <th>
                            <h1><b>Ngày đặt hàng</b></h1>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            <h2>#IN024279 </h2>
                        </th>
                        <th>
                            <h2>05/01/2023</h2>
                        </th>
                        <th>
                            <h2>UKRHPWTNA </h2>
                        </th>
                        <th>
                            <h2>05/01/2023</h2>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <h2>#IN024279 </h2>
                        </th>
                        <th>
                            <h2>05/01/2023</h2>
                        </th>
                        <th>
                            <h2>UKRHPWTNA </h2>
                        </th>
                        <th>
                            <h2>05/01/2023</h2>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="" style="margin-top: 35px">
            <table style="border: 2px solid black; width: 100%; border-spacing: 0">
                <thead>
                    <tr style="background: rgb(240 240 240);">
                        <th>
                            <h1><b>Sản phẩm</b></h1>
                        </th>
                        <th>
                            <h1><b>Thuế</b></h1>
                        </th>
                        <th>
                            <h1><b>Đơn giá</b></h1>
                        </th>
                        <th>
                            <h1><b>Số lượng</b></h1>
                        </th>
                        <th>
                            <h1><b>Tổng cộng</b></h1>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>
                            <h2>Nhẫn bạc nam Hà Nội đơn giản NNA0222 - size nam : 20</h2>
                        </th>
                        <th>

                        </th>
                        <th>
                            <h2>279.000 ₫</h2>
                        </th>
                        <th>
                            <h2>1</h2>
                        </th>
                        <th>
                            <h2>279.000 ₫</h2>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="" style="margin-top: 35px; display: flex; justify-content: space-between">
            <div class="" style="width: 49%">
                <table style="border: 2px solid black; width: 100%; border-spacing: 0">
                    <thead>
                        <tr style="background: rgb(240 240 240);">
                            <th>
                                <h1><b>Chi tiết thuế</b></h1>
                            </th>
                            <th>
                                <h1><b>Thuế</b></h1>
                            </th>
                            <th>
                                <h1><b>Giá cơ bản</b></h1>
                            </th>
                            <th>
                                <h1><b>Tổng thuế</b></h1>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <h2>Không thuế</h2>
                            </th>
                            <th>
                                <h2>Không thuế</h2>
                            </th>
                            <th>
                                <h2>Không thuế</h2>
                            </th>
                            <th>
                                <h2>Không thuế</h2>
                            </th>
                        </tr>
                    </tbody>
                </table>

                <table style="border: 2px solid black; width: 100%; border-spacing: 0; margin-top: 35px">
                    <thead>
                        <tr style="background: rgb(240 240 240);">
                            <th>
                                <h1><b>Phương thức thanh toán</b></h1>
                            </th>
                            <th>
                                <h1><b>Nhà vận chuyển</b></h1>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                <h2>Thanh toán khi nhận hàng (COD)</h2>
                            </th>
                            <th>
                                <h2>Bưu điện</h2>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="" style="width: 49%">
                <table style="border: 2px solid black; width: 100%; border-spacing: 0; margin-top: 35px">
                    <tr>
                        <th style="background: rgb(240 240 240);">
                            <h2>Tổng sản phẩm</h2>
                        </th>
                        <th>
                            <h2>279.000 ₫</h2>
                        </th>
                    </tr>
                    <tr>
                        <th style="background: rgb(240 240 240);">
                            <h2>Chi phí vận chuyển</h2>
                        </th>
                        <th>
                            <h2>30.000 ₫</h2>
                        </th>
                    </tr>
                    <tr>
                        <th style="background: rgb(240 240 240);">
                            <h2><b>Tổng cộng (chưa bao gồm thuế)</b></h2>
                        </th>
                        <th>
                            <h2><b>309.000 ₫</b></h2>
                        </th>
                    </tr>
                    <tr>
                        <th style="background: rgb(240 240 240);">
                            <h1><b>Tổng cộng</b></h1>
                        </th>
                        <th>
                            <h1><b>309.000 ₫</b></h1>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html> --}}
