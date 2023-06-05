<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/admin/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/admin/img/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>
        admin
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/admin/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/nucleo-svg.css') }}" rel="stylesheet" />
    {{-- Ionic icon --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/admin/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/admin/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/side_bar/css/style.css') }}">
</head>

<style>
    *{
        font-family: 'Roboto', sans-serif !important;
    }

    .dropdown-menu {
        inset: auto !important;
    }

    .dropdown ul.show {
        margin-top: -30px !important;
    }
</style>

<div class="bg-green1 p-2 d-flex align-items-center justify-content-between w-100 fixed-top">
    <div class="w-25" style="height: 42px;">
        <img class="w-auto h-100" src="{{ asset('assets/web-imgs/logo.png') }}" alt="">
    </div>
    <div class="w-50 d-flex justify-content-center">
        <a class="mx-2 fs-6" href="/admin"
            @if (explode('/', $url = url()->current())[count(explode('/', $url = url()->current())) - 1] == 'admin') style="color: #fff; font-weight: 700" @else style = "color: #fff" @endif>Dashboard</a>

        <a class="mx-2 fs-6" href="/admin/sanpham"
            @if (explode('/', $url = url()->current())[count(explode('/', $url = url()->current())) - 1] == 'sanpham' ||
                    explode('/', $url = url()->current())[count(explode('/', $url = url()->current())) - 1] == 'themsanpham' ||
                    explode('/', $url = url()->current())[count(explode('/', $url = url()->current())) - 1] == 'chinhsuasanpham') style="color: #fff; font-weight: 700" @else style = "color: #fff" @endif>Sản
            phẩm</a>

        <a class="mx-2 fs-6" href="/admin/danhmucvaloaisanpham"
            @if (explode('/', $url = url()->current())[count(explode('/', $url = url()->current())) - 1] == 'danhmucvaloaisanpham') style="color: #fff; font-weight: 700" @else style = "color: #fff" @endif>Danh
            mục
            và loại sản phẩm</a>

        <a class="mx-2 fs-6" href="/admin/khuyenmai"
            @if (explode('/', $url = url()->current())[count(explode('/', $url = url()->current())) - 1] == 'khuyenmai') style="color: #fff; font-weight: 700" @else style = "color: #fff" @endif>Khuyến
            mãi
        </a>

        <a class="mx-2 fs-6" href="/admin/donhang"
            @if (explode('/', $url = url()->current())[count(explode('/', $url = url()->current())) - 1] == 'donhang') style="color: #fff; font-weight: 700" @else style = "color: #fff" @endif>Đơn
            hàng
        </a>

        <a class="mx-2 fs-6" href="/admin/taikhoan"
            @if (explode('/', $url = url()->current())[count(explode('/', $url = url()->current())) - 1] == 'taikhoan') style="color: #fff; font-weight: 700" @else style = "color: #fff" @endif>
            Tài khoản</a>
    </div>
    <div class="w-25 fs-6 d-flex justify-content-end me-4">
        <a href="/dangxuat" class="text-danger fw-bold">Đăng xuất</a>
    </div>
</div>

<!-- Page Content  -->
<div id="content" class="p-4 p-md-2 pt-5" style="margin-top: 47px !important">
    @yield('content')
</div>
{{-- </div> --}}

<script src="{{ asset('assets/admin/side_bar/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/side_bar/js/popper.js') }}"></script>
<script src="{{ asset('assets/admin/side_bar/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/side_bar/js/main.js') }}"></script>

<script src="{{ asset('assets/admin/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
{{-- <script src="{{ asset('assets/admin/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script> --}}
</body>

</html>
