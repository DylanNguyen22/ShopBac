@extends('admin.layout_admin')

@section('content')
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
                            </div>
                            <form action="/admin/themsanpham-luu" method="POST" enctype="multipart/form-data">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Tên sản phẩm:</span>
                                    <input name="TenSP" type="text" class="form-control" aria-label="Username"
                                        aria-describedby="basic-addon1" required>
                                </div>
                                <div class="d-flex">
                                    <div class="w-25">
                                        <select name="ChatLieu" class="form-select" aria-label="Default select example" id="chatlieu" required>
                                            @foreach ($data[3] as $item)
                                                <option value="{{ $item->MaCL }}">{{ $item->TenCL }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="input-group mb-3 w-25 mx-2">
                                        <span class="input-group-text" id="basic-addon1">Mã tra cứu:</span>
                                        <input name="MaTraCuu" type="text" id="price" onkeyup="a()"
                                            class="form-control" aria-label="Username" aria-describedby="basic-addon1"
                                            maxlength="20" required>
                                    </div>

                                    <div class="input-group mb-3 w-25 me-2">
                                        <span class="input-group-text" id="basic-addon1">Số lượng:</span>
                                        <input name="SoLuong" type="text" id="price" onkeyup="a()"
                                            class="form-control" aria-label="Username" aria-describedby="basic-addon1"
                                            maxlength="20" required>
                                    </div>

                                    <div class="w-25">
                                        <select name="LoaiKichThuoc" class="form-select"
                                            aria-label="Default select example" required>
                                            @foreach ($data[4] as $item)
                                                <option value="{{ $item[0] }}">{{ $item[1] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="MoTa" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                        style="height: 350px" required></textarea>
                                    <label for="floatingTextarea2">Mô tả</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="ChiTiet" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                        style="height: 350px" required></textarea>
                                    <label for="floatingTextarea2">Chi tiết</label>
                                </div>
                                <div class="d-flex">
                                    <div class="w-25 mx-1">
                                        <select name="TrangThai" class="form-select" aria-label="Default select example" required>
                                            <option value="0">Đưa lên kệ</option>
                                            <option selected value="1">Chưa lên kệ</option>
                                        </select>
                                    </div>

                                    <div class="input-group mb-3 w-25 mx-1">
                                        <span class="input-group-text" id="basic-addon1">Đơn giá:</span>
                                        <input name="DonGia" type="text" id="price" onkeyup="a()"
                                            class="form-control" aria-label="Username" aria-describedby="basic-addon1" required>
                                    </div>

                                    <div class="w-50 mx-1">
                                        <select name="MaLoai" class="form-select" aria-label="Default select example" required>
                                            @foreach ($data[1] as $item)
                                                <option value="{{ $item->MaLoai }}">{{ $item->TenLoai }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mx-1 mb-3 d-flex">
                                    <div class="d-flex flex-column align-items-center w-25 rounded border border-dark">
                                        <span class="rounded-top v">Ảnh thumbnail</span>
                                        <div class="w-100 d-flex align-items-center">
                                            <input type="file" name="AnhBia" class="form-control"
                                                id="inputGroupFile01" required>
                                        </div>
                                    </div>

                                    <div
                                        class="mx-1 d-flex flex-column align-items-center w-75 rounded border border-dark">
                                        <span class="rounded-top v">Ảnh mô tả</span>
                                        <div class="w-100 d-flex align-items-center">
                                            <input type="file" name="AnhSP[]" multiple class="form-control"
                                                id="inputGroupFile01" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Video (mã nhúng):</span>
                                        <input name="Video" type="text" class="form-control" aria-label="Username">
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
