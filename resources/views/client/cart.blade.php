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
    <div class="top_header_left mb-1">
        <span class="text-light p-2">
            <ion-icon class="ms-4" name="headset"></ion-icon> Hotline: 0976 827 283 - Email: trangsuctnj@gmail.com
        </span>
    </div>
    <a href="/" class="btn btn-danger ms-2 mb-4">trở về trang chủ</a>
    <div class="container">
        <!-- Thanh tiêu đề -->
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Giỏ hàng</a>
            </div>
        </nav>
        <!-- Danh sách sản phẩm -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sản phẩm trong giỏ hàng</h5>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0" scope="col" style="width: 40px;">Hình ảnh</th>
                                    <th class="border-0" scope="col">Tên sản phẩm</th>
                                    <th class="border-0" scope="col">Giá tiền</th>
                                    <th class="border-0" scope="col">Số lượng</th>
                                    <th class="border-0" scope="col">Thành tiền</th>
                                    <th class="border-0" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @if (isset($cart))
                                    @foreach ($cart as $item)
                                        <tr class="border-0">
                                            <td class="border-0"><img
                                                    src="{{ asset('/storage/product_imgs/' . $item['HinhAnh']) }}"
                                                    alt=""></td>
                                            <td class="border-0">{{ $item['TenSanPham'] }}</td>
                                            <td class="border-0">{{ number_format($item['DonGia'], 0, ',', '.') }}đ</td>
                                            {{-- <td class="border-0">{{ $item['SoLuong'] }}</td> --}}
                                            <td class="border-0">
                                                <div class="d-flex">
                                                    <a href="/giohang/tangsoluong?soluong={{ $item['SoLuong'] }}&id={{ $item['MaSanPham'] }}&hanhdong=increase"
                                                        class="btn btn-primary">+</a>
                                                    <div class="btn bg-0">{{ $item['SoLuong'] }}</div>
                                                    <a href="/giohang/tangsoluong?soluong={{ $item['SoLuong'] }}&id={{ $item['MaSanPham'] }}&hanhdong=decrease"
                                                        class="btn btn-primary">-</a>
                                                </div>
                                            </td>
                                            <td class="border-0">
                                                {{ number_format($item['DonGia'] * $item['SoLuong'], 0, ',', '.') }}đ
                                            </td>
                                            <td class="border-0">
                                                <form action="/giohang/xoakhoigiohang" method="POST">
                                                    <input type="hidden" name="ProductId"
                                                        value="{{ $item['MaSanPham'] }}">
                                                    <button class="btn btn-danger">Xóa</button>
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                        @php
                                            $total += $item['DonGia'] * $item['SoLuong'];
                                        @endphp
                                    @endforeach
                                @elseif (isset($data))
                                    @foreach ($data as $item)
                                        <tr class="border-0">
                                            <td class="border-0"><img
                                                    src="{{ asset('/storage/product_imgs/' . $item->TenAnh) }}"
                                                    alt=""></td>
                                            <td class="border-0">{{ $item->TenSP }}</td>
                                            <td class="border-0">{{ number_format($item->DonGia, 0, ',', '.') }}đ</td>
                                            {{-- <td class="border-0">{{ $item->SoLuong }}</td> --}}
                                            <td class="border-0">
                                                <div class="d-flex">
                                                    <a href="/giohang/tangsoluong?soluong={{ $item->SoLuong }}&id={{ $item->MaSP }}&hanhdong=increase"
                                                        class="btn btn-primary">+</a>
                                                    <div class="btn bg-0">{{ $item->SoLuong }}</div>
                                                    <a href="/giohang/tangsoluong?soluong={{ $item->SoLuong }}&id={{ $item->MaSP }}&hanhdong=decrease"
                                                        class="btn btn-primary">-</a>
                                                </div>
                                            </td>
                                            <td class="border-0">
                                                {{ number_format($item->DonGia * $item->SoLuong, 0, ',', '.') }}đ</td>
                                            <td class="border-0">
                                                <div class="d-flex justify-content-around">
                                                    <form action="/giohang/xoakhoigiohang" method="POST">
                                                        <input type="hidden" name="ProductId"
                                                            value="{{ $item->MaSP }}">
                                                        <button class="btn btn-danger">Xóa</button>
                                                        @csrf
                                                    </form>
                                                    <form action="/donhang/muangay" method="POST">
                                                        <input type="hidden" value="{{ $item->DonGia }}"
                                                            name="GiaTien">
                                                        <input type="hidden" value="{{ $item->MaSP }}"
                                                            name="MaSP">
                                                        <input type="hidden" name="SoLuong"
                                                            value="{{ $item->SoLuong }}">
                                                        <button class="btn btn-primary" type="submit">Thanh
                                                            toán</button>
                                                        @csrf
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $total += $item->DonGia * $item->SoLuong;
                                        @endphp
                                    @endforeach
                                @else
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Thành tiền -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tổng tiền: {{ number_format($total, 0, ',', '.') }}đ</h5>
                        @if ($total == 0)
                            <a class="btn btn-secondary">ThanhToan</a>
                        @else
                            <a class="btn btn-primary" href="/donhang/thanhtoangiohang">ThanhToan</a>
                        @endif
                    </div>
                </div>
            </div>
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
