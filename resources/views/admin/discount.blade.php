@extends('admin.layout_admin')

@section('content')
    <style>
        th,
        td {
            font-size: 13px !important;
            text-align: center;
        }

        table {
            background-color: none !important;
        }
    </style>

    <div class="py-4">
        <div class="row">
            <div class="col-12">
                <div class="mb-4">
                    <div class="card-header pb-0">
                        <h6>Khuyến mãi</h6>
                    </div>
                    <div class="ms-0 my-4">
                        @if (isset(session()->all()['msg']))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('msg') }}
                            </div>
                        @endif
                        <span></span>
                    </div>

                    <div class="ms-0 my-4 d-flex justify-content-end pe-4">
                        <form action="/admin/themkhuyenmai" method="POST">
                            <div class="d-flex border-green rounded" style="width: fit-content;">
                                <div class="input-group" style="width: 156px;">
                                    <select class="form-select border-0" aria-label="Default select example"
                                        name="phantramkm">
                                        @for ($i = 1; $i <= 100; $i++)
                                            <option value="{{ $i }}">{{ $i }}%</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="input-group" style="width: 250px">
                                    <span class="input-group-text rounded-0 bg-green text-light" id="basic-addon1">Ngày bắt
                                        đầu</span>
                                    <input type="date" class="form-control border-0 ps-2" placeholder="Username"
                                        name="ngaybatdau" aria-label="Username" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group" style="width: 250px">
                                    <span class="input-group-text rounded-0 bg-green text-light" id="basic-addon1">Ngày kết
                                        thúc</span>
                                    <input type="date" class="form-control border-0 ps-2" placeholder="Username"
                                        name="ngayketthuc" aria-label="Username" aria-describedby="basic-addon1" required>
                                </div>
                                <button type="submit" class="btn btn-green m-0 rounded-0 px-5">Lưu</button>
                                @csrf
                            </div>
                        </form>
                    </div>

                    <div class="card-body mx-1 px-0 pt-0 pb-2">
                        @foreach ($data[0] as $key => $item)
                            <div class="mb-2 d-flex border-green rounded p-2 justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span class="fs-6 border-end pe-2 border-4 border-success"><b class="text-green">Mã
                                            khuyến mãi:</b> {{ $item->MaKM }}</span>
                                            <span class="fs-6 border-end ms-2 pe-2 border-4 border-success"><b class="text-green">Phần
                                                trăm khuyến mãi:</b> {{ $item->PhanTramKM }}%</span>
                                    <span class="ms-2 fs-6 border-end pe-2 border-4 border-success"><b
                                            class="text-green">Ngày bắt đầu:</b> {{ $item->NgayBatDau }}</span>
                                    <span class="ms-2 fs-6 border-end pe-2 border-4 border-success"><b
                                            class="text-green">Ngày kết thúc:</b> {{ $item->NgayHetHan }}</span>
                                    <span class="ms-2 fs-6 border-end pe-2 border-4 border-success"><b class="text-green">Số
                                            ngày đã áp dụng:</b>@if ($item->SoNgayDaApDung <= 0) 0 @else {{$item->SoNgayDaApDung}} @endif</span>
                                    <span class="ms-2 fs-6 border-end pe-2 border-4 border-success"><b class="text-green">Số
                                            ngày còn lại:</b>@if ($item->SoNgayDaApDung >= 0) 0 @else {{ substr($item->SoNgayConLai, 1) }} @endif </span>
                                </div>

                                <div class="d-flex align-items-center">
                                    @if ($item->TrangThai == 0)
                                        <a href="/admin/thaydoitrangthaikhuyenmai?id={{ $item->MaKM }}"
                                            class="btn btn-light m-0">
                                            <ion-icon class="fs-5 text-success" name="close-circle-outline"></ion-icon>
                                        </a>
                                    @else
                                        <a href="/admin/thaydoitrangthaikhuyenmai?id={{ $item->MaKM }}"
                                            class="btn btn-light m-0">
                                            <ion-icon class="fs-5 text-danger" name="close-circle-outline"></ion-icon>
                                        </a>
                                    @endif
                                    <a href="/admin/xoakhuyenmai?id={{$item->MaKM}}" class="btn btn-danger m-0 mx-2">Xóa</a>
                                    <span class="hover" id="showMore{{ $key }}"
                                        onclick="document.getElementById('productList{{ $key }}').style.height = 'fit-content'; document.getElementById('showMore{{ $key }}').style.display = 'none'; document.getElementById('hideMore{{ $key }}').style.display = 'block'; ">Chi
                                        tiết &#9660;</span>
                                    <span class="hover" id="hideMore{{ $key }}"
                                        onclick="document.getElementById('productList{{ $key }}').style.height = '0px'; document.getElementById('showMore{{ $key }}').style.display = 'block'; document.getElementById('hideMore{{ $key }}').style.display = 'none';"
                                        style="display: none">Chi tiết &#9650;</span>
                                </div>
                            </div>
                            <div class="" style="height: 0px; overflow: hidden;" id="productList{{ $key }}">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                                Mã sản phẩm
                                            </th>
                                            <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                                Hình ảnh
                                            </th>
                                            <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                                Tên sản phẩm
                                            </th>
                                            <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                                Đơn giá
                                            </th>
                                            <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                                Giá được giảm
                                            </th>
                                            <th>

                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data[1] as $item1)
                                            @if ($item->MaKM == $item1->MaKM)
                                                <tr>
                                                    <td class="fs-6">{{ $item1->MaSP }}</td>
                                                    <td>
                                                        <img style="width: 63px"
                                                            src="{{ asset('/storage/product_imgs/' . $item1->TenAnh) }}"
                                                            alt="">
                                                    </td>
                                                    <td class="fs-6">{{ $item1->TenSP }}</td>
                                                    <td class="fs-6 text-success">{{ $item1->DonGia }}</td>
                                                    <td class="fs-6 text-danger">
                                                        {{ ($item1->DonGia / 100) * $item1->PhanTramKM }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="d-flex justify-content-end">
                                                <a href="/admin/themsanphamchokhuyenmai?id={{ $item->MaKM }}"
                                                    class="btn btn-green">Chỉnh sửa khuyến mãi</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
