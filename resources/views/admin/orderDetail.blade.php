@extends('admin.layout_admin')

@section('content')
    <style>
        img {
            width: 75px;
        }

        .top_header_left {
            background-color: rgb(3, 107, 90);
        }
    </style>

    @php
        $total = 0;
        $arrId = '';
    @endphp

    <div class="m-5">
        <span class="fs-4 fw-bold">Chi tiết đơn hàng</span>

        @if ($orderInfo[0]->TrangThai == 1)
            <form action="/admin/chinhsuathongtindonhang" method="POST">
                <input type="hidden" name="MaDH" value="{{ $_GET['id'] }}">
                @csrf
                <div class="shadow mt-2 d-flex justify-content-around">
                    <div class="p-2"><b class="fs-normal ">Nhà vận chuyển </b><span class="fs-normal ">Bưu điện</span>
                    </div>
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
                        <input value="{{ $orderInfo[0]->TenNguoiNhan }}" type="text" class="form-control"
                            aria-label="Username" aria-describedby="basic-addon1" name="HoTen">
                        <input value="{{ $orderInfo[0]->DiaChi }}" type="text" class="form-control" aria-label="Username"
                            aria-describedby="basic-addon1" name="DiaChi">
                        <input value="{{ '0' . $orderInfo[0]->SoDienThoai }}" type="text" class="form-control"
                            aria-label="Username" aria-describedby="basic-addon1" name="SoDienThoai">
                        <span class="fs-normal"></span>
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
                                <th class="border-0"></th>
                                <th class="border-0" scope="col">Tên sản phẩm</th>
                                <th class="border-0" scope="col">Kích thước</th>
                                <th class="border-0" scope="col">Số lượng</th>
                                <th class="border-0" scope="col">Đơn giá</th>
                                <th class="border-0" scope="col">Tổng giá</th>
                            </tr>
                        </thead>
                        <tbody id="checkedProduct2">

                        </tbody>
                        <tbody>
                            @foreach ($orderInfo as $key => $item)
                                <tr class="border-0" id="productRows{{ $key }}">
                                    <th class="border-0">
                                        <button type="button" class="btn btn-danger"
                                            onclick="this.parentNode.parentNode.remove(this.parentNode); document.getElementById('arrId').value = document.getElementById('arrId').value.replace('{{ $item->MaSP }}|','')">
                                            Xóa</button>
                                    </th>
                                    <th class="border-0">
                                        <span>{{ $item->TenSP }}</span><br>
                                        <span>Tham chiếu: {{ $item->MaTraCuu }}</span>
                                    </th>
                                    <th class="border-0">
                                        @php
                                            $sizeArr = explode('|', $item->KichThuoc);
                                        @endphp
                                        @if ($item->LoaiKichThuoc == 1)
                                            <span>Kích thước nam:</span>
                                            <select name="KichThuocNam{{ $item->MaSP }}" id=""
                                                class="form-select" aria-label="Default select example" style="width: 65px">
                                                @for ($i = 10; $i < 22; $i++)
                                                    @if ($i == $item->KichThuoc)
                                                        <option selected value="{{ $i }}">{{ $i }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $i }}">{{ $i }}
                                                        </option>
                                                    @endif
                                                @endfor
                                            </select>
                                        @endif
                                        @if ($item->LoaiKichThuoc == 2)
                                            <span>Kich thước nữ:</span>
                                            <select name="KichThuocNu{{ $item->MaSP }}" id=""
                                                class="form-select" aria-label="Default select example" style="width: 65px">
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
                                        @if ($item->LoaiKichThuoc == 3)
                                            <span>Kích thước nam:</span>
                                            <select name="KichThuocNam{{ $item->MaSP }}" id=""
                                                class="form-select" aria-label="Default select example" style="width: 65px">
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
                                            <select name="KichThuocNu{{ $item->MaSP }}" id=""
                                                class="form-select" aria-label="Default select example"
                                                style="width: 65px">
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
                                    </th>
                                    <th class="border-0">
                                        <select class="form-select" name="SoLuong{{ $item->MaSP }}"
                                            aria-label="Default select example">
                                            @for ($i = 1; $i <= $item->SL; $i++)
                                                @if ($item->SoLuong == $i)
                                                    <option selected value="{{ $i }}">{{ $i }}
                                                    </option>
                                                @else
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </th>
                                    <th class="border-0">
                                        <input type="hidden" name="DonGia{{ $item->MaSP }}"
                                            value="{{ $item->DonGia }}">
                                        <span class="text-info">{{ number_format($item->DonGia, 0, ',', '.') }}đ</span>
                                    </th>
                                    <th class="border-0">
                                        <span
                                            class="text-info">{{ number_format($item->DonGia * $item->SoLuong, 0, ',', '.') }}đ</span>
                                    </th>
                                </tr>
                                @php
                                    $total += $item->DonGia * $item->SoLuong;
                                    $arrId .= $item->MaSP . '|';
                                @endphp
                            @endforeach
                            <tr class="border-0">
                                <th class="border-0"></th>
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
                                <th class="border-0"></th>
                                <th class="border-0">Giao hàng và xử lý:</th>
                                <th class="border-0 text-info">{{ number_format(30000, 0, ',', '.') }}đ</th>
                            </tr>
                            <tr class="border-0">
                                <th class="border-0"></th>
                                <th class="border-0"></th>
                                <th class="border-0"></th>
                                <th class="border-0"></th>
                                <th class="border-0">Tổng cộng:</th>
                                <th class="border-0 text-info">{{ number_format($total + 30000, 0, ',', '.') }}đ</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="MaSP" id="arrId" value="{{ $arrId }}">
                <div class="d-flex justify-content-end m-4">
                    <button class="btn btn-green">Xác nhận</button>
                </div>
            </form>
            <div class="border-green" style="height: 364px; overflow: hidden; overflow-y: scroll">
                <div class="input-group m-3 w-25">
                    <span class="input-group-text" id="basic-addon1">Tìm kiếm: </span>
                    <input type="text" class="form-control" id="searchInput" placeholder="Username"
                        aria-label="Username" aria-describedby="basic-addon1"
                        onkeyup="var input, filter, ul, li, a, i, txtValue;input = document.getElementById('search4');filter = input.value.toUpperCase();ul = document.getElementById('MyUL2');li = ul.getElementsByTagName('li');for (i = 0; i < li.length; i++) {a = li[i].getElementsByTagName('a')[0];txtValue = a.textContent || a.innerText;if (txtValue.toUpperCase().indexOf(filter) > -1){li[i].style.display = '';} else {li[i].style.display = 'none';}}">
                </div>

                <table id="productTable" class="table table-striped table-hover">
                    <thead>
                        <tr class="border-0">
                            <th class="border-0" scope="col"></th>
                            <th class="border-0" scope="col">Tên sản phẩm</th>
                            <th class="border-0" scope="col">Kích thước</th>
                            <th class="border-0" scope="col">Số lượng</th>
                            <th class="border-0" scope="col">Đơn giá</th>
                            <th class="border-0" scope="col">Tổng giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key1 => $item3)
                            <tr class="border-0" id="abc{{ $item3['MaSP'] }}">
                                <td class="border-0">
                                    <div class="checkbox-wrapper-1 me-2">
                                        <button class="btn btn-success" name="inProduct" type="button"
                                            id="abcc{{ $item3['MaSP'] }}" type="checkbox"
                                            onclick="document.getElementById('arrId').value = document.getElementById('arrId').value+{{ $item3['MaSP'] }}+'|' ;content = document.getElementById('abc{{ $item3['MaSP'] }}'); console.log(content);parent = document.getElementById('checkedProduct2');parent.appendChild(content.cloneNode(true)); var button = document.createElement('button');button.innerHTML = 'Xóa'; button.className = 'btn btn-danger'; elem = document.getElementById('abcc{{ $item3['MaSP'] }}'); elem.parentNode.replaceChild(button, elem);button.onclick = function() {this.parentNode.parentNode.remove(this.parentNode)}; document.getElementById('inList').value += '{{ $item3['MaSP'] }}|';">
                                            Thêm
                                        </button>
                                    </div>
                                </td>
                                <td class="border-0">
                                    {{ $item3['TenSP'] }}
                                </td>
                                <td class="border-0">
                                    @php
                                        $sizeArr = explode('|', $item->KichThuoc);
                                    @endphp
                                    @if ($item3['LoaiKichThuoc'] == 1)
                                        <span>Kích thước nam:</span>
                                        <select name="KichThuocNam{{ $item3['MaSP'] }}" id=""
                                            class="form-select" aria-label="Default select example" style="width: 65px">
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
                                    @if ($item3['LoaiKichThuoc'] == 2)
                                        <span>Kich thước nữ:</span>
                                        <select name="KichThuocNu{{ $item3['MaSP'] }}" id=""
                                            class="form-select" aria-label="Default select example" style="width: 65px">
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
                                    @if ($item3['LoaiKichThuoc'] == 3)
                                        <span>Kích thước nam:</span>
                                        <select name="KichThuocNam{{ $item3['MaSP'] }}" id=""
                                            class="form-select" aria-label="Default select example" style="width: 65px">
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
                                        <select name="KichThuocNu{{ $item3['MaSP'] }}" id=""
                                            class="form-select" aria-label="Default select example" style="width: 65px">
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
                                <td class="border-0">
                                    <select class="form-select" name="SoLuong{{ $item3['MaSP'] }}"
                                        aria-label="Default select example">
                                        @for ($i = 1; $i <= $item3['SoLuong']; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </td>
                                <td class="border-0">
                                    <input type="hidden" name="DonGia{{ $item3['MaSP'] }}"
                                        value="{{ $item3['DonGia'] }}">
                                    <span class="text-info">{{ number_format($item3['DonGia'], 0, ',', '.') }}đ</span>
                                </td>
                                <td class="border-0">
                                    <span class="text-info">{{ number_format($item3['DonGia'], 0, ',', '.') }}đ</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <span class="fs-4 fw-bold">Chi tiết đơn hàng</span>

            <div class="shadow mt-2 d-flex justify-content-around">
                <div class="p-2"><b class="fs-normal ">Nhà vận chuyển </b><span class="fs-normal ">Bưu điện</span>
                </div>
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
                                        <span>Kích thước nam: {{ $item->KichThuoc }}</span>
                                    @endif
                                    @if ($item->LoaiKichThuoc == 2)
                                        <span>Kích thước nữ: {{ $item->KichThuoc }}</span>
                                    @endif
                                    @if ($item->LoaiKichThuoc == 3)
                                        <span>Kích thước nam: {{ $sizeArr[0] }}</span><br>
                                        <span>Kích thước nữ: {{ $sizeArr[1] }}</span>
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
        @endif
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
    <script>
        const searchInput = document.getElementById("searchInput");
        const rows = document.querySelectorAll("#productTable tbody tr");
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
