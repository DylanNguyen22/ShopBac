<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đặt hàng</title>
    {{-- ionicons --}}
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- Nạp các tệp CSS của Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <script src="{{ asset('assets/js/main.js') }}"></script>
</head>

<style>
    img {
        width: 75px;
    }

    .top_header_left {
        background-color: rgb(3, 107, 90);
    }
</style>

<body>
    <div class="top_header_left mb-1">
        <span class="text-light p-2">
            <ion-icon class="ms-4" name="headset"></ion-icon> Hotline: 0976 827 283 - Email: trangsuctnj@gmail.com
        </span>
    </div>
    <a href="/" class="btn btn-danger ms-2 mb-4">trở về trang chủ</a>

    <div class="mx-5">
        <div class="fs-2">Lịch sử đơn hàng</div>
        <div class="d-flex justify-content-center">
            <span class="fs-5">Đây là các đơn đặt hàng bạn có kể từ khi tạo tài khoản này</span>
        </div>
        <div class="">
            <table class="table table-striped table-hover">
                <thead>
                    <tr class="border-0">
                        <th class="border-0" scope="col">Mã đặt hàng</th>
                        <th class="border-0" scope="col">Ngày</th>
                        <th class="border-0" scope="col">Tổng giá</th>
                        <th class="border-0" scope="col">Trạng thái</th>
                        <th class="border-0" scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userOrder as $item)
                        <tr class="border-0">
                            <td class="border-0">{{ $item[0] }}</td>
                            <td class="border-0">{{ $item[1] }}</td>
                            <td class="border-0">{{ $item[2] }}</td>
                            <td class="border-0">
                                @if ($item[4] == 1)
                                    Đang chờ xác nhận
                                @endif
                                @if ($item[4] == 2)
                                    Đã xác nhận
                                @endif
                                @if ($item[4] == 3)
                                    Đã giao cho đơn vị vận chuyển
                                @endif
                                @if ($item[4] == 4)
                                    Giao hàng thành công
                                @endif
                                @if ($item[4] == 5)
                                    Đã hủy
                                @endif
                                @if ($item[4] == 6)
                                    Giao hàng không thành công
                                @endif
                            </td>
                            <td class="border-0"><a href="/donhang/chitietdonhang?id={{$item[5]}}" class="fs-5">chi tiết</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="footer mt-2 py-5 d-flex flex-column align-items-center">
        <div class="footer_logo">
            <img src="{{ asset('assets/web-imgs/footer_logo.png') }}" alt="">
        </div>
        <div class="footer_criteria my-3">
            <span class="text-light">Luôn nâng cao dịch vụ khách hàng và chất lượng sản phẩm là giá trị cốt lõi mà
                Trang
                Sức TNJ hướng đến.</span>
        </div>
        <div class="footer_socialNetworkAddress">
            <span class="fs-3 mx-2 footer_socialNetworkAddress_facebook">
                <ion-icon name="logo-facebook"></ion-icon>
            </span>
            <span class="fs-3 mx-2 footer_socialNetworkAddress_twitter">
                <ion-icon name="logo-twitter"></ion-icon>
            </span>
            <span class="fs-3 mx-2 footer_socialNetworkAddress_google">
                <ion-icon name="logo-google"></ion-icon>
            </span>
            <span class="fs-3 mx-2 footer_socialNetworkAddress_pinterest">
                <ion-icon name="logo-pinterest"></ion-icon>
            </span>
            <span class="fs-3 mx-2 footer_socialNetworkAddress_instagram">
                <ion-icon name="logo-instagram"></ion-icon>
            </span>
            <span class="fs-3 mx-2 footer_socialNetworkAddress_skype">
                <ion-icon name="logo-skype"></ion-icon>
            </span>
        </div>
    </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"
    integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>
