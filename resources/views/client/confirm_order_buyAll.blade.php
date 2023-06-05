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

    <div class="container">
        <p class="fs-3 m-0">Đặt hàng</p>
        <p>Vui lòng kiểm tra thông tin của trước khi tiến hành đặt hàng</p>
        <form action="/donhang/taodonhangthanhtoantatca" method="POST">
            <div class="d-flex">
                <div class="w-50 me-1">
                    <span class="fs-5">Địa chỉ giao hàng <ion-icon name="location"></ion-icon></span>
                    <div class="">
                        @php
                            $x = 0;
                        @endphp
                        @foreach ($Address as $key => $item)
                            @if ($key == 0)
                                <div class="address d-flex p-2 rounded">
                                    <input type="radio" id="address1" checked name="address1"
                                        value="{{ $item->DiaChi . '|' . $item->SoDienThoai . '|' . $item->HoVaTen }}">
                                    <label for="address1" class="ms-2">
                                        <ul style="list-style-type: circle;">
                                            <li>Địa chỉ: {{ $item->DiaChi }}</li>
                                            <li>Số điện thoại: 0{{ $item->SoDienThoai }}</li>
                                            <input type="hidden" name="phone" value="{{ $item->SoDienThoai }}">
                                            <input type="hidden" name="name" value="{{ $item->HoVaTen }}">
                                            <li>Họ tên: {{ $item->HoVaTen }}</li>
                                        </ul>
                                        <a href="/xoadiachi?id={{ $item->MaDC }}"
                                            class="text-danger text-decoration-none">Xóa địa chỉ này</a>
                                    </label>
                                </div>
                            @else
                                <div class="address d-flex p-2 rounded">
                                    <input type="radio" id="address2" name="address1"
                                        value="{{ $item->DiaChi . '|' . $item->SoDienThoai . '|' . $item->HoVaTen }}">
                                    <label for="address2" class="ms-2">
                                        <ul style="list-style-type: circle;">
                                            <li>Địa chỉ: {{ $item->DiaChi }}</li>
                                            <li>Số điện thoại: 0{{ $item->SoDienThoai }}</li>
                                            <li>Họ tên: {{ $item->HoVaTen }}</li>
                                        </ul>
                                        <a href="/xoadiachi?id={{ $item->MaDC }}"
                                            class="text-danger text-decoration-none">Xóa địa chỉ này</a>
                                    </label>
                                </div>
                            @endif
                            @php
                                ++$x;
                            @endphp
                        @endforeach
                        @if ($x < 2)
                            <div class="add_Address mb-1 d-flex p-2 rounded align-items-center justify-content-center"
                                onclick="document.getElementById('addAddress').style.display = 'block';"
                                style="cursor: pointer">
                                <a class="fs-5 text-decoration-none">Thêm địa chỉ mới</a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="ms-1">
                    <div class="">
                        <span class="fs-5">Phương thức vận chuyển <svg style="width: 3.7%"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path
                                    d="M48 0C21.5 0 0 21.5 0 48V368c0 26.5 21.5 48 48 48H64c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H48zM416 160h50.7L544 237.3V256H416V160zM112 416a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm368-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                            </svg></span>

                        <div class="address d-flex p-2 rounded">
                            <input type="radio" id="ship" name="ship" checked>
                            <label for="ship" class="ms-2">
                                <img style="width: 17%;" src="{{ asset('assets/web-imgs/21.jpg') }}" alt="">
                                <span>Bưu điện | 3 đến 4 ngày (30.000đ)</span>
                            </label>
                        </div>
                    </div>
                    <div class="">
                        <span class="fs-5">Phương thức thanh toán <ion-icon name="card"></ion-icon></span>

                        <div class="d-flex">
                            <div class="me-1 w-50 address d-flex p-2 rounded" style="width: fit-content;">
                                <input type="radio" id="pay1" name="pay1" checked value="1">
                                <label for="pay1" class="ms-2">
                                    <img style="width: 35%;" src="{{ asset('assets/web-imgs/navcard2.png') }}"
                                        alt=""><br>
                                    <span>Chuyển khoản</span>
                                </label>
                            </div>
                            <div class="ms-1 w-50 address d-flex p-2 rounded" style="width: fit-content;">
                                <input type="radio" id="pay2" name="pay1" value="2">
                                <label for="pay2" class="ms-2">
                                    <img style="width: 21%;" src="{{ asset('assets/web-imgs/5229335.png') }}"
                                        alt=""><br>
                                    <span>Thanh toán khi nhận hàng</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <span class="fs-5">Tóm Tắt đơn hàng <ion-icon name="checkbox"></ion-icon></span>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="border-0">
                            <th class="border-0" scope="col" style="width: 40px;">Hình ảnh</th>
                            <th class="border-0" scope="col">Tên sản phẩm</th>
                            <th class="border-0" scope="col">Kích thước</th>
                            <th class="border-0" scope="col">Giá tiền</th>
                            <th class="border-0" scope="col">Số lượng</th>
                            <th class="border-0" scope="col">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $TongCon = 0;
                            $Product_info = "";
                        @endphp
                        @if (isset($orderInfo))
                            @foreach ($orderInfo as $key => $item)
                                <tr class="border-0">
                                    <td class="border-0"><img
                                            src="{{ asset('/storage/product_imgs/' . $item->TenAnh) }}"
                                            alt="">
                                    </td>
                                    <td class="border-0">{{ $item->TenSP }}</td>
                                    <td class="border-0">
                                        @if ($item->LoaiKichThuoc == 0)
                                            <span>Không có</span>
                                        @endif
                                        @if($item->LoaiKichThuoc == 1)
                                            <span>Kích thước nam:</span>
                                            <select name="KichThuocNam{{$key}}" id="">
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                            </select>
                                        @endif
                                        @if($item->LoaiKichThuoc == 2)
                                            <span>Kich thước nữ:</span>
                                            <select name="KichThuocNu{{$key}}" id="">
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                            </select>
                                        @endif
                                        @if($item->LoaiKichThuoc == 3)
                                        <span>Kích thước nam:</span>
                                        <select name="KichThuocNam{{$key}}" id="">
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                        </select><br>
                                            <span>Kích thước nữ:</span>
                                            <select name="KichThuocNu{{$key}}" id="">
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                            </select><br>
                                        @endif
                                    </td>
                                    <td id="price" class="border-0">
                                        {{ $item->DonGia }}
                                    </td>
                                    <td class="border-0">
                                        <input type="hidden" id="Quantity" value="{{ $item->SoLuongSP }}">
                                        <a href="/donhang/thaydoisoluong?action=increase&id={{ $item->MaSP }}"
                                            type="button" class="btn btn-primary">+</a>
                                        <span id="orderQuantity">{{ $item->SoLuong }}</span>
                                        <input type="hidden" id="inputQuantity" name="SoLuong"
                                            value="{{ $item->SoLuong }}">
                                        <a href="/donhang/thaydoisoluong?action=decrease&id={{ $item->MaSP }}"
                                            type="button" class="btn btn-primary">-</a>
                                    </td>
                                    <td id="total" class="border-0">
                                        {{ number_format($item->DonGia * $item->SoLuong, 0, ',', '.') }}đ</td>
                                </tr>
                                @php
                                    $TongCon += $item->DonGia * $item->SoLuong;
                                    $Product_info .= $item->MaSP."-".$item->DonGia."-".$item->SoLuong."|";
                                @endphp
                            @endforeach
                            <input type="hidden" name="Product_info" value="{{$Product_info}}">
                            <input type="hidden" name="locate" value="1">
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between">
                <div class="">
                    <div class="d-flex align-items-center">
                        <span class="fs-5">Tổng tiền&nbsp;</span>
                        <ion-icon name="cash"></ion-icon>
                    </div>
                    <span id="total1">Tổng con: {{ number_format($TongCon, 0, ',', '.') }}đ</span><br>
                    <input type="hidden" id="totall" value="{{ $TongCon }}">
                    <input id="total2" type="hidden" name="TongCong" value="{{ $TongCon + 30000 }}">
                    <span>Vận chuyển: {{ number_format(30000, 0, ',', '.') }}đ</span><br>
                    <b id="sumTotal">TỔNG CỘNG: {{ number_format($TongCon + 30000, 0, ',', '.') }}đ</b>
                </div>

                <div class="">
                    <button type="submit" class="btn btn-primary">Thanh toán</button>
                </div>
            </div>
            @csrf
        </form>

    </div>

    <div class="" id="addAddress" style="display: none">
        <div class="d-flex w-100 justify-content-center position-absolute top-50 start-50 translate-middle">
            <div class="addAddress bg-light w-50 p-4 rounded">
                <div class="d-flex justify-content-center">
                    <h3>Vui lòng nhập đầy đủ thông tin bên dưới!</h3>
                </div>
                <form action="/themdiachi" method="POST">
                    <div class="d-flex">
                        <div class="d-flex w-100">
                            <select class="form-select m-1" name="tinh/thanh" id="province" required>
                            </select>
                            <select class="form-select m-1" name="quan/huyen" id="district" required>
                                <option value="">chọn quận/huyện</option>
                            </select>
                            <select class="form-select m-1" name="phuong/xa" id="ward" required>
                                <option value="">chọn phường/xã</option>
                            </select>
                        </div>
                    </div>
                    <input type="text" class="form-control m-1" placeholder="Số nhà/đường" name="sonha/duong"
                        aria-label="Server" required>
                    <div class="d-flex">
                        <input type="hidden" id="tinh/thanh" name="tinh/thanh">
                        <input type="hidden" id="quan/huyen" name="quan/huyen">
                        <input type="hidden" id="phuong/xa" name="phuong/xa">

                        <input type="text" class="w-25 form-control m-1" placeholder="Họ" name="Ho"
                            aria-label="Server" required>
                        <input type="text" class="w-25 form-control m-1" placeholder="Tên" name="Ten"
                            aria-label="Server" required>
                        <input type="text" class="w-50 form-control m-1" placeholder="Số điện thoại"
                            name="SDT" aria-label="Server" required>
                    </div>
                    @csrf
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success w-25 m-1">Lưu</button>
                        <button type="button" class="btn btn-danger w-25 m-1"
                            onclick="document.getElementById('addAddress').style.display = 'none';">Hủy</button>
                    </div>
                </form>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"
    integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./index.js"></script>
<script>
    var a = sessionStorage.getItem("number");
    if (a == 1) {
        location.reload();
    }
    sessionStorage.setItem("number", 2);

    const host = "https://provinces.open-api.vn/api/";
    var callAPI = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data, "province");
            });
    }
    callAPI('https://provinces.open-api.vn/api/?depth=1');
    var callApiDistrict = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data.districts, "district");
            });
    }
    var callApiWard = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data.wards, "ward");
            });
    }

    var renderData = (array, select) => {
        let row = ' <option disable value="">Chọn</option>';
        array.forEach(element => {
            row += `<option value="${element.code}">${element.name}</option>`
        });
        document.querySelector("#" + select).innerHTML = row
    }

    $("#province").change(() => {
        document.getElementById("tinh/thanh").value = $("#province option:selected").text();
        callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
        printResult();
    });
    $("#district").change(() => {
        document.getElementById("quan/huyen").value = $("#district option:selected").text();
        callApiWard(host + "d/" + $("#district").val() + "?depth=2");
        printResult();
    });
    $("#ward").change(() => {
        document.getElementById("phuong/xa").value = $("#ward option:selected").text();
        printResult();
    })

    var printResult = () => {
        if ($("#district").val() != "" && $("#province").val() != "" &&
            $("#ward").val() != "") {
            let result = $("#province option:selected").text() +
                " | " + $("#district option:selected").text() + " | " +
                $("#ward option:selected").text();
            $("#result").text(result)
        }
    }
</script>

</html>
