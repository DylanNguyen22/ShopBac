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
                            style="height: 500px; overflow: hidden; overflow-y: scroll; overflow-x: scroll; display: none">
                            <table id="productTable" class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Mã sản phẩm
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Hình ảnh
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tên sản phẩm
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Trạng thái
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Đơn giá
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Kích cỡ
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Số lượng
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Loại
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Danh mục
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($search as $key => $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <span>{{ $item['MaSP'] }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <img style="width: 63px"
                                                    src="{{ asset('/storage/product_imgs/' . $item['TenAnh']) }}"
                                                    alt="">
                                            </td>
                                            <td>
                                                <div class=""
                                                    style="max-width: 285px; line-height: 1.3; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                                    <span>{{ $item['TenSP'] }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($item['TrangThai'] == 0)
                                                    <span class="text-success">Đang trên kệ</span>
                                                @else
                                                    <span class="text-danger">Chưa lên kệ</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item['PhanTramKM'] == $item['DonGia'])
                                                    <div class="">
                                                        <span>Giá hiện tại: </span>
                                                        <span
                                                            class="text-success">{{ number_format($item['DonGia'], 0, ',', '.') }}</span>
                                                    </div>
                                                @else
                                                    <div class="">
                                                        <span>Giá cũ: </span>
                                                        <span
                                                            class="text-danger text-decoration-line-through">{{ number_format($item['DonGia'], 0, ',', '.') }}</span>
                                                    </div>
                                                    <div class="">
                                                        <span>Giá hiện tại: </span>
                                                        <span
                                                            class="text-success">{{ number_format($item['PhanTramKM'], 0, ',', '.') }}</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item['LoaiKichThuoc'] == 1)
                                                    <span>Kích thước nam</span>
                                                @elseif ($item['LoaiKichThuoc'] == 2)
                                                    <span>Kích thước nữ</span>
                                                @elseif ($item['LoaiKichThuoc'] == 3)
                                                    <span>Kích thước đôi</span>
                                                @else
                                                    <span>Không có</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span>{{ $item['SoLuong'] }}</span>
                                            </td>
                                            <td>
                                                <span>{{ $item['TenLoai'] }}</span>
                                            </td>
                                            <td>
                                                <span>{{ $item['TenDanhMuc'] }}</span>
                                            </td>
                                            <td>
                                                @if ($item['TrangThai'] == 0)
                                                    <span class=""><a class="btn btn-success"
                                                            href="/admin/thaydoitrangthaisanpham?id={{ $item['MaSP'] }}">
                                                            <ion-icon class="fs-6" name="eye"></ion-icon>
                                                        </a></span>
                                                @else
                                                    <span class=""><a class="btn btn-danger"
                                                            href="/admin/thaydoitrangthaisanpham?id={{ $item['MaSP'] }}">
                                                            <ion-icon name="eye-off"></ion-icon>
                                                        </a></span>
                                                @endif
                                                <a class="btn btn-info"
                                                    href="/admin/chinhsuasanpham?id={{ $item['MaSP'] }}">Sửa
                                                </a>
                                                <a href="/admin/xoasanpham?id={{ $item['MaSP'] }}"
                                                    class="btn btn-danger">Xóa</a>
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
                                            Mã sản phẩm
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Hình ảnh
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tên sản phẩm
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Trạng thái
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Đơn giá
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Kích cỡ
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Số lượng
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Loại
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Danh mục
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <span>{{ $item['MaSP'] }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <img style="width: 63px"
                                                    src="{{ asset('/storage/product_imgs/' . $item['TenAnh']) }}"
                                                    alt="">
                                            </td>
                                            <td>
                                                <div class=""
                                                    style="max-width: 285px; line-height: 1.3; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                                    <span>{{ $item['TenSP'] }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($item['TrangThai'] == 0)
                                                    <span class="text-success">Đang trên kệ</span>
                                                @else
                                                    <span class="text-danger">Chưa lên kệ</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item['PhanTramKM'] == $item['DonGia'])
                                                    <div class="">
                                                        <span>Giá hiện tại: </span>
                                                        <span
                                                            class="text-success">{{ number_format($item['DonGia'], 0, ',', '.') }}</span>
                                                    </div>
                                                @else
                                                    <div class="">
                                                        <span>Giá cũ: </span>
                                                        <span
                                                            class="text-danger text-decoration-line-through">{{ number_format($item['DonGia'], 0, ',', '.') }}</span>
                                                    </div>
                                                    <div class="">
                                                        <span>Giá hiện tại: </span>
                                                        <span
                                                            class="text-success">{{ number_format($item['PhanTramKM'], 0, ',', '.') }}</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item['LoaiKichThuoc'] == 1)
                                                    <span>Kích thước nam</span>
                                                @elseif ($item['LoaiKichThuoc'] == 2)
                                                    <span>Kích thước nữ</span>
                                                @elseif ($item['LoaiKichThuoc'] == 3)
                                                    <span>Kích thước đôi</span>
                                                @else
                                                    <span>Không có</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span>{{ $item['SoLuong'] }}</span>
                                            </td>
                                            <td>
                                                <span>{{ $item['TenLoai'] }}</span>
                                            </td>
                                            <td>
                                                <span>{{ $item['TenDanhMuc'] }}</span>
                                            </td>
                                            <td>
                                                @if ($item['TrangThai'] == 0)
                                                    <span class=""><a class="btn btn-success"
                                                            href="/admin/thaydoitrangthaisanpham?id={{ $item['MaSP'] }}">
                                                            <ion-icon class="fs-6" name="eye"></ion-icon>
                                                        </a></span>
                                                @else
                                                    <span class=""><a class="btn btn-danger"
                                                            href="/admin/thaydoitrangthaisanpham?id={{ $item['MaSP'] }}">
                                                            <ion-icon name="eye-off"></ion-icon>
                                                        </a></span>
                                                @endif
                                                <a class="btn btn-info"
                                                    href="/admin/chinhsuasanpham?id={{ $item['MaSP'] }}">Sửa
                                                </a>
                                                {{-- <a href="/admin/xoasanpham?id={{ $item['MaSP'] }}"
                                                    class="btn btn-danger">Xóa</a> --}}
                                                <button class="btn btn-danger me-2"
                                                    onclick="document.getElementById('deleteAlert{{ $item['MaSP'] }}').style.display = 'block';">Xóa</button>
                                            </td>
                                        </tr>
                                        <div class="position-fixed top-30 bg-light" id="deleteAlert{{ $item['MaSP'] }}"
                                            style="display: none; margin-left: 387px; margin-top: -88px; width: 600px; height: 330px; box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset; z-index: 9999;">
                                            <div class="text-center">
                                                <span class="fs-5 text-danger">Xóa sản phẩm này sẽ gây ảnh hưởng đến các đơn hàng đã lưu có sản phẩm này</span><br>
                                                <ion-icon class="text-danger" name="alert-circle-outline"
                                                    style="font-size: 145px"></ion-icon><br>
                                                <span class="fs-5">Bạn chắc chắn chứ ?</span>
                                                <div class="mt-3">
                                                    <button type="button"
                                                        onclick="location.href='/admin/xoasanpham?id={{ $item['MaSP'] }}'"
                                                        class="btn btn-lg btn-success mx-5">Xác
                                                        nhận</button>
                                                    <button type="button"
                                                        onclick="document.getElementById('deleteAlert{{ $item['MaSP'] }}').style.display = 'none';"
                                                        class="btn btn-lg btn-danger mx-5">Hủy bỏ</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $data->links() !!}
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
