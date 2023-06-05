@extends('admin.layout_admin')

@section('content')
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 3px;
            height: 3px;
        }

        ::-webkit-scrollbar-track {
            background: #1a9404;
        }

        th,
        td {
            font-size: 13px !important;
            text-align: center;
        }
    </style>

    <div class="py-4">
        <div class="row">
            <div class="col-12">
                <div class="mb-4">
                    <div class="card-header pb-0">
                        <h6>Sản phẩm</h6>
                    </div>
                    <div class="ms-0 my-4">
                        @if (isset(session()->all()['msg']))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('msg') }}
                            </div>
                        @endif
                        <span></span>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="input-group mb-3 w-25 ms-3">
                            <span class="input-group-text" id="basic-addon1">
                                <ion-icon class="fs-3" name="search-circle"></ion-icon>
                            </span>
                            <input type="text" id="searchInput" onkeyup="search()" class="form-control ps-2"
                                placeholder="Bạn cần tìm gì?..." aria-describedby="basic-addon1">
                        </div>
                        <button class="btn btn-green m-3" onclick="window.location.href='/admin/themsanpham'">
                            <ion-icon name="add-outline"></ion-icon> Thêm
                        </button>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div id="searchResult" onkeyup="open()" class="table-responsive p-0"
                            style="height: 260; overflow: hidden; overflow-y: scroll; overflow-x: scroll; display: none">
                            <table id="productTable" class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Mã tài khoản
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Email
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Loại tài khoản
                                        </th>

                                        <th>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usersSearch as $key => $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <span>{{ $item['MaTK'] }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="">
                                                    <span>{{ $item['Email'] }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($item['LoaiTK'] == 1)
                                                    <span class="text-success">Khách</span>
                                                @else
                                                    <span class="text-danger">Admin</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item['TrangThai'] == 0)
                                                    <a href="/admin/thaydoitrangthaitaikhoan?id={{$item['MaTK']}}" class="btn btn-light">
                                                        <ion-icon class="fs-6 text-success" name="lock-open"></ion-icon>
                                                    </a>
                                                @else
                                                    <a href="/admin/thaydoitrangthaitaikhoan?id={{$item['MaTK']}}" class="btn btn-light">
                                                        <ion-icon class="fs-6 text-danger" name="lock-closed"></ion-icon>
                                                    </a>
                                                @endif
                                                <a href="/admin/xoataikhoan?id={{$item['MaTK']}}" class="btn btn-danger fs-6">
                                                    Xóa
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Mã tài khoản
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Email
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Loại tài khoản
                                        </th>

                                        <th>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <span>{{ $item['MaTK'] }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="">
                                                    <span>{{ $item['Email'] }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($item['LoaiTK'] == 1)
                                                    <span class="text-success">Khách</span>
                                                @else
                                                    <span class="text-danger">Admin</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item['TrangThai'] == 0)
                                                    <a href="/admin/thaydoitrangthaitaikhoan?id={{$item['MaTK']}}" class="btn btn-light">
                                                        <ion-icon class="fs-6 text-success" name="lock-open"></ion-icon>
                                                    </a>
                                                @else
                                                    <a href="/admin/thaydoitrangthaitaikhoan?id={{$item['MaTK']}}" class="btn btn-light">
                                                        <ion-icon class="fs-6 text-danger" name="lock-closed"></ion-icon>
                                                    </a>
                                                @endif
                                                <a href="/admin/xoataikhoan?id={{$item['MaTK']}}" class="btn btn-danger fs-6">
                                                    Xóa
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $users->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            made with <i class="fa fa-heart"></i> by
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative
                                Tim</a>
                            for a better web.
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        const searchInput = document.getElementById("searchInput");
        const rows = document.querySelectorAll("#productTable tbody tr");

        searchInput.addEventListener("input", function() {
            a = document.getElementById("searchInput").value;
            if (a != "") {
                document.getElementById("searchResult").style.display = "block";
            } else {
                document.getElementById("searchResult").style.display = "none";
            }
        });

        searchInput.addEventListener("keyup", function(event) {
            const searchValue = event.target.value.toLowerCase().trim();
            rows.forEach(function(row) {
                const cells = row.querySelectorAll("td");
                if (searchValue === "") {
                    row.style.display = "";
                    return;
                }
                let matchFound = false;
                cells.forEach(function(cell) {
                    if (cell.textContent.toLowerCase().trim().indexOf(searchValue) !== -1) {
                        matchFound = true;
                    }
                });
                if (matchFound) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    </script>
@endsection
