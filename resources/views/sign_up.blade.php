<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Boostrap 5 --}}
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
    <a href="/" style="z-index: 20000" class="btn btn-danger">Trở về trang chủ</a>

    <div class="sign_up" id="sign_up">
        <div class="wrapper">
            <div id="logo">
                <img src="{{ asset('assets/web-imgs/logo.png') }}" alt="">
            </div>
            <form class="p-3 mt-3" method="POST" action="/dangky">
                <div class="form-field d-flex align-items-center m-0">
                    <span class="far fa-user"></span>
                    <input type="text" name="Email" id="Email" placeholder="Email">
                </div>
                @error('Email')
                    <span class="text-danger ms-4">*{{ $message }}</span>
                @enderror
                <div class="form-field d-flex align-items-center m-0 mt-2">
                    <span class="fas fa-key"></span>
                    <input type="password" name="Password" id="pwd" placeholder="Mật khẩu">
                </div>
                @error('Password')
                    <span class="text-danger ms-4">*{{ $message }}</span>
                @enderror
                <div class="form-field d-flex align-items-center m-0 mt-2">
                    <span class="fas fa-key"></span>
                    <input type="password" name="Re_password" id="re_pwd" placeholder="Nhập lại mật khẩu">
                </div>
                @error('Re_password')
                    <span class="text-danger ms-4">*{{ $message }}</span>
                @enderror
                <button id="sign_in_btn" class="btn mt-3">Đăng ký</button>
                @csrf
            </form>
            <div class="text-center fs-6">
                Đã có tài khoản? <a href="/dangnhap" class="fs-6">Đăng nhập</a>
            </div>
        </div>
    </div>

</body>

</html>
