<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giỏ hàng</title>
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
    @php
        $total = 0;
    @endphp

    <div class="top_header_left mb-1">
        <span class="text-light p-2">
            <ion-icon class="ms-4" name="headset"></ion-icon> Hotline: 0976 827 283 - Email: trangsuctnj@gmail.com
        </span>
    </div>
    <a href="/" class="btn btn-danger ms-2 mb-4">trở về trang chủ</a>

    <div class="m-5">
        <span class="fs-4 fw-bold">Chi tiết đơn hàng</span>

        <div class="shadow mt-2 d-flex justify-content-around">
            <div class="p-2"><b class="fs-normal ">Nhà vận chuyển </b><span class="fs-normal ">Bưu điện</span></div>
            <div class="p-2"><b class="fs-normal">Phương thức thanh toán </b>
                <span class="fs-normal">
                    @if ($orderInfo[0]->LoaiThanhToan == 1)
                        Thanh toán khi nhận hàng (COD)
                    @else
                        Thanh toán trực tuyến
                    @endif
                </span>
            </div>
            <div class="p-2"><a href="" class="text-green text-decoration-none fs-normal">Tải về biên nhận
                    dưới dạng pdf</a></div>
        </div>

        <div class="my-3 d-flex">
            <div class="w-50 shadow me-3 p-3">
                <b class="fw-bold fs-5">Địa chỉ giao hàng</b><br>
                <span class="fs-normal">{{ $orderInfo[0]->TenNguoiNhan }}</span><br>
                <span class="fs-normal">{{ $orderInfo[0]->DiaChi }}</span><br>
                <span class="fs-normal">{{ '0' . $orderInfo[0]->SoDienThoai }}</span>
            </div>

            <div class="w-50 shadow ms-3 p-3">
                <b class="fw-bold fs-5">Địa chỉ giao hóa đơn</b><br>
                <span class="fs-normal">{{ $orderInfo[0]->TenNguoiNhan }}</span><br>
                <span class="fs-normal">{{ $orderInfo[0]->DiaChi }}</span><br>
                <span class="fs-normal">{{ '0' . $orderInfo[0]->SoDienThoai }}</span>
            </div>
        </div>
        <div class="shadow">
            <table class="table table-striped table-hover">
                <thead>
                    <tr class="border-0">
                        <th class="border-0" scope="col">Tên sản phẩm</th>
                        <th class="border-0" scope="col">Kích thước</th>
                        <th class="border-0" scope="col">Số lượng</th>
                        <th class="border-0" scope="col">Đơn giá</th>
                        <th class="border-0" scope="col">Tổng giá</th>
                        <th class="border-0" scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderInfo as $item)
                        <tr class="border-0">
                            <th class="border-0">
                                <span>{{ $item->TenSP }}</span><br>
                                <span>Tham chiếu: {{ $item->MaTraCuu }}</span>
                            </th>
                            <th class="border-0">
                                @php
                                    $sizeArr = explode('|', $item->KichThuoc);
                                @endphp
                                @if ($item->LoaiKichThuoc == 0)
                                    <span>Không có</span>
                                @endif
                                @if ($item->LoaiKichThuoc == 1)
                                    <span>Kích thước nam: {{$item->KichThuoc}}</span>
                                @endif
                                @if ($item->LoaiKichThuoc == 2)
                                    <span>Kích thước nữ: {{$item->KichThuoc}}</span>
                                @endif
                                @if ($item->LoaiKichThuoc == 3)
                                    <span>Kích thước nam: {{$sizeArr[0]}}</span><br>
                                    <span>Kích thước nữ: {{$sizeArr[1]}}</span>
                                @endif
                            </th>
                            <th class="border-0">
                                <span>{{ $item->SoLuong }}</span>
                            </th>
                            <th class="border-0">
                                <span class="text-info">{{ number_format($item->DonGia, 0, ',', '.') }}đ</span>
                            </th>
                            <th class="border-0">
                                <span
                                    class="text-info">{{ number_format($item->DonGia * $item->SoLuong, 0, ',', '.') }}đ</span>
                            </th>
                        </tr>
                        @php
                            $total += $item->DonGia * $item->SoLuong;
                        @endphp
                    @endforeach
                    <tr class="border-0">
                        <th class="border-0"></th>
                        <th class="border-0"></th>
                        <th class="border-0"></th>
                        <th class="border-0">Tổng con:</th>
                        <th class="border-0 text-info">{{ number_format($total, 0, ',', '.') }}đ</th>
                    </tr>
                    <tr class="border-0">
                        <th class="border-0"></th>
                        <th class="border-0"></th>
                        <th class="border-0"></th>
                        <th class="border-0">Giao hàng và xử lý:</th>
                        <th class="border-0 text-info">{{ number_format(30000, 0, ',', '.') }}đ</th>
                    </tr>
                    <tr class="border-0">
                        <th class="border-0"></th>
                        <th class="border-0"></th>
                        <th class="border-0"></th>
                        <th class="border-0">Tổng cộng:</th>
                        <th class="border-0 text-info">{{ number_format($total + 30000, 0, ',', '.') }}đ</th>
                    </tr>
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

</html>
