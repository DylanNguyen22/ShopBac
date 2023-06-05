@php
    $session = Session::get('user');
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Boostrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    {{-- ionicons --}}
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <title>Document</title>
</head>

<body>
    <div class="mx-3">
        <div class="header">
            <div class="top_header d-flex align_items-center justify-content-between my-1 mx-5">
                <div class="top_header_left">
                    <span>
                        <ion-icon name="headset"></ion-icon> Hotline: 0976 827 283 - Email: trangsuctnj@gmail.com
                    </span>
                </div>
                @if (isset($session))
                    <div class="dropdown">
                        <button class="user_info d-flex align-items-center" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Tài khoản&nbsp;<ion-icon name="person"></ion-icon>
                        </button>
                        <div class="user_dropdown_menu dropdown-menu py-2 pb-2">
                            <div class="account_feature">
                                <div class="user_icon">
                                    <ion-icon id="user_icon" name="person-circle" style="font-size: 100px"></ion-icon>
                                </div>
                                <div class="menu_items">
                                    <div class="menu_item">
                                        <a class="" href="/donhang/danhsachdonhang">Lịch sử và chi tiết đơn
                                            hàng</a>
                                    </div>
                                    <div class="menu_item">
                                        <a class="text-danger" href="/dangxuat">Đăng xuất</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @else
                    <div class="top_header_right">
                        <!-- <a href="" class="d-flex align-items-center link"><ion-icon name="person-sharp"></ion-icon> Tài khoản</a> -->
                        <a href="/dangky">Đăng ký</a> / <a href="/dangnhap">Đăng nhập</a>
                    </div>
                @endif
            </div>

            <div class="mid_header py-4 d-flex align-items-center justify-content-around">
                <div class="mid_header_logo">
                    <a href="/"><img src="{{ asset('assets/web-imgs/logo.png') }}" alt=""></a>
                </div>
                <div class="mid_header_catagory d-flex">
                    @foreach ($data[0] as $key => $item)
                        <div class="mid_header_catagory_item"
                            onmouseout="document.getElementById('mid_header_catagory_item_dropdown-{{ $key }}').style.display = 'none'"
                            onmouseover="document.getElementById('mid_header_catagory_item_dropdown-{{ $key }}').style.display = 'block'">
                            <a href="/danhmuc?id={{ $item->MaDanhMuc }}"
                                class="mid_header_catagory_item_link link text-light mx-2 position-relative text-uppercase">{{ $item->TenDanhMuc }}</a>
                            <div class="mid_header_catagory_item_dropdown position-absolute bg-light p-2 px-3"
                                id="mid_header_catagory_item_dropdown-{{ $key }}">
                                <hr>
                                @foreach ($data[1] as $key1 => $item1)
                                    @if ($item->MaDanhMuc == $item1->MaDanhMuc)
                                        <a href="/theloai?id={{ $item1->MaLoai }}"
                                            class="link ms-2">{{ $item1->TenLoai }}</a><br>
                                        <hr>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mid_header_feature">
                    <form action="/chuanbitukhoa" method="post">
                        <div class="mid_header_feature_search input-group">
                            <input type="text" name="key-word" class="form-control" placeholder="Bạn cần tìm gì ...?"
                                id="myInput" onkeyup="search()" aria-label="Recipient's username"
                                aria-describedby="button-addon2">
                            <button class="btn btn-light" type="submit" id="button-addon2">
                                <ion-icon name="search-outline"></ion-icon>
                            </button>
                            @csrf
                        </div>
                    </form>
                </div>
                <div class="mid_header_feature_cart">
                    <a href="/giohang" class="text-light">
                        <ion-icon class="fs-3" name="cart-outline"></ion-icon>
                    </a>
                </div>
            </div>
            <div class="bot_header d-flex justify-content-around">
                <div class="bot_header_left d-flex align-items-center">
                    <ion-icon class="fs-5" name="paper-plane"></ion-icon>
                    <span class="fs-5">&nbsp;Giao hàng&nbsp;</span>
                    <span class="text-secondary">| Toàn quốc</span>
                </div>
                <div class="bot_header_left d-flex align-items-center">
                    <ion-icon class="fs-4" name="car"></ion-icon>
                    <span class="fs-5">&nbsp;Free Ship&nbsp;</span>
                    <span class="text-secondary">| Khi đặt từ 2 sản phẩm trở lên </span>
                </div>
                <div class="bot_header_left d-flex align-items-center">
                    <ion-icon class="fs-5" name="wallet"></ion-icon>
                    <span class="fs-5">&nbsp;Hoàn Tiền&nbsp;</span>
                    <span class="text-secondary">| Nếu hàng không chất lượng</span>
                </div>
            </div>

            <div id="searchResult" class="position-absolute top-0 end-0 bg-light w-25 rounded shadow"
                style="z-index: 300; margin-right: 21px; margin-top: 100px; max-height: 650px; overflow-y: scroll; display: none;">
                <ul id="myUL">
                    @foreach ($data[3] as $item)
                        <li>
                            <a href="chitietsanpham?id={{$item->MaSP}}" class="text-decoration-none text-dark fw-bold hover_green">
                                <div class="d-flex align-items-center my-2">
                                    <div class="me-2" style="width: 45px; min-width: 45px;"><img class="w-100"
                                            src="{{ asset('/storage/product_imgs/' . $item->TenAnh) }}"
                                            alt="">
                                    </div>
                                    <div class=""
                                        style="line-height: 1.3; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $item->TenSP }}</div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        @yield('content')

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
    </div>
    <script>
        function search() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("searchResult");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "block";
                    ul.style.display = "block";
                } else {
                    li[i].style.display = "none";
                }
            }
            if (document.getElementById("myInput").value == '') {
                ul.style.display = "none";
            }
        }
    </script>
</body>

</html>
