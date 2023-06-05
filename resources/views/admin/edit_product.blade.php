@extends('admin.layout_admin')

@section('content')
    <style>
        ::-webkit-scrollbar {
            height: 1px;
        }

        ::-webkit-scrollbar {
            width: 2px;
        }

        ::-webkit-scrollbar-track {
            background: #00bc16;
        }
    </style>

    <div class="py-4">
        <div class="row">
            <div class="col-12">
                <div class="mb-4">
                    <div class="d-flex justify-content-center mb-3">
                        <div class="w-75">
                            <div class="ms-0 my-4">
                                <h6>Chỉnh sửa sản phẩm</h6>
                            </div>
                            <div class="ms-0 my-4">
                                @if (isset(session()->all()['msg']))
                                    <div class="alert alert-success" role="alert">
                                        {{ session()->get('msg') }}
                                    </div>
                                @endif
                                <span></span>
                            </div>
                            <form action="/admin/chinhsuasanpham-luu" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="MaSP" value="{{ $data[0][0]->MaSP }}">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Tên sản phẩm:</span>
                                    <input name="TenSP" type="text" class="form-control" aria-label="Username"
                                        aria-describedby="basic-addon1" value="{{ $data[0][0]->TenSP }}">
                                </div>
                                <div class="d-flex">
                                    <div class="w-25">
                                        <select name="ChatLieu" class="form-select" aria-label="Default select example">
                                            @foreach ($data[3] as $item)
                                                @if ($data[0][0]->MaCL == $item->MaCL)
                                                    <option selected value="{{ $item->MaCL }}">{{ $item->TenCL }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item->MaCL }}">{{ $item->TenCL }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="input-group mb-3 w-25 mx-2">
                                        <span class="input-group-text" id="basic-addon1">Mã tra cứu:</span>
                                        <input name="MaTraCuu" type="text" id="price" onkeyup="a()"
                                            class="form-control" aria-label="Username" aria-describedby="basic-addon1"
                                            value="{{ $data[0][0]->MaTraCuu }}" maxlength="20">
                                    </div>

                                    <div class="input-group mb-3 w-25 me-2">
                                        <span class="input-group-text" id="basic-addon1">Số lượng:</span>
                                        <input name="SoLuong" type="text" id="price" onkeyup="a()"
                                            class="form-control" aria-label="Username" aria-describedby="basic-addon1"
                                            value="{{ $data[0][0]->SoLuong }}" maxlength="20">
                                    </div>

                                    <div class="w-25">
                                        <select name="LoaiKichThuoc" class="form-select"
                                            aria-label="Default select example">
                                            @foreach ($data[4] as $item)
                                                @if ($data[0][0]->LoaiKichThuoc == $item[0])
                                                    <option selected value="{{ $item[0] }}">{{ $item[1] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item[0] }}">{{ $item[1] }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="MoTa" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                        style="height: 350px">{{ $data[0][0]->MoTa }}</textarea>
                                    <label for="floatingTextarea2">Mô tả</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="ChiTiet" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                        style="height: 350px">{{ $data[0][0]->ChiTiet }}</textarea>
                                    <label for="floatingTextarea2">Chi tiết</label>
                                </div>
                                <div class="d-flex">
                                    <div class="w-25 mx-1">
                                        <select name="TrangThai" class="form-select" aria-label="Default select example">
                                            @if ($data[0][0]->TrangThai == 0)
                                                <option selected value="0">Đang trên kệ</option>
                                                <option value="1">Lấy xuống kệ</option>
                                            @else
                                                <option selected value="1">Chưa lên kệ</option>
                                                <option value="0">Đưa lên kệ</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="input-group mb-3 w-25 mx-1">
                                        <span class="input-group-text" id="basic-addon1">Đơn giá:</span>
                                        <input name="DonGia" type="text" id="price" onkeyup="a()"
                                            class="form-control" aria-label="Username" aria-describedby="basic-addon1"
                                            value="{{ $data[0][0]->DonGia }}">
                                    </div>

                                    <div class="w-50 mx-1">
                                        <select name="MaLoai" class="form-select" aria-label="Default select example">
                                            @foreach ($data[1] as $item)
                                                @if ($data[0][0]->MaLoai == $item->MaLoai)
                                                    <option selected value="{{ $item->MaLoai }}">{{ $item->TenLoai }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item->MaLoai }}">{{ $item->TenLoai }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mx-1 mb-3 d-flex">
                                    <div class="d-flex flex-column align-items-center w-25 rounded border border-dark" style="height: 260.5px;">
                                        <span class="rounded-top v">Ảnh thumbnail</span>
                                        @foreach ($data[2] as $item)
                                            @if ($item->LoaiAnh == 1)
                                                <img class="rounded-bottom" style="height: 74.8%; width: auto"
                                                    src="{{ asset('/storage/product_imgs/' . $item->TenAnh) }}"
                                                    alt="">
                                            @endif
                                        @endforeach
                                        <div class="w-100 d-flex align-items-center">
                                            <input type="file" name="AnhBia" class="form-control"
                                                id="inputGroupFile01">
                                        </div>
                                    </div>

                                    <div
                                        class="mx-1 d-flex flex-column align-items-center w-75 rounded border border-dark">
                                        <span class="rounded-top v">Ảnh mô tả</span>
                                        <div class="d-flex w-100"
                                            style="height: 194.8px; overflow: hidden; overflow-x: scroll">
                                            @foreach ($data[2] as $item)
                                                @if ($item->LoaiAnh == 0)
                                                    <img class="rounded-bottom" style="height: 100%; width: auto"
                                                        src="{{ asset('/storage/product_imgs/' . $item->TenAnh) }}"
                                                        alt="">
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="w-100 d-flex align-items-center">
                                            <input type="file" name="AnhSP[]" multiple class="form-control"
                                                id="inputGroupFile01">
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="">
                                        @php
                                            echo '' . $data[0][0]->Video;
                                        @endphp
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Video (mã nhúng):</span>
                                        <input name="Video" type="text" class="form-control" aria-label="Username"
                                            aria-describedby="basic-addon1" value="{{ $data[0][0]->Video }}">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-success w-25 mx-2" type="submit">Lưu</button>
                                    <button class="btn btn-danger w-25 mx-2" type="button"
                                        onclick="history.back()">hủy</button>
                                </div>
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
