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
                        <h6>Danh mục và loại sản phẩm</h6>
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
                        <form action="/admin/themdanhmuc" method="POST">
                            <div class="">
                                <div class="input-group mb-3 w-25 ms-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <ion-icon class="fs-3" name="search-circle"></ion-icon>
                                    </span>
                                    <input type="text" id="searchInput" class="form-control ps-2"
                                        placeholder="Bạn cần tìm gì ?..." aria-label="Username"
                                        aria-describedby="basic-addon1">
                                </div>
                                <div class="d-flex justify-content-end me-5">
                                    <div class="">
                                        <input name="tendanhmuc" class="border-green rounded-start p-1" type="text"
                                            style="width: 265px" placeholder="Nhập tên danh mục cần thêm mới">
                                    </div>
                                    <div class="">
                                        <button class="btn-green p-1 pe-3 border-green rounded-end" type="submit">
                                            <ion-icon name="add-outline"></ion-icon> Thêm
                                        </button>
                                    </div>
                                    @csrf
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div id="searchResult" onkeyup="open()" class="table-responsive p-0 mb-5"
                            style="height: 500px; overflow: hidden; overflow-y: scroll; overflow-x: scroll; display: none">
                            <table id="categoryTable" class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            Mã danh mục
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            &emsp;&emsp;&emsp;&emsp;&emsp;Tên danh mục&emsp;&emsp;&emsp;&emsp;&emsp;
                                        </th>
                                        <th></th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                            Mã loại
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                            Tên loại
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($result as $key => $item)
                                        <tr class="">
                                            <td class="fs-6 bg-green text-light">{{ $item[0] }}</td>
                                            <td class="fs-6 bg-green text-light">
                                                <div class="" id="categoryName{{ $key }}a">
                                                    {{ $item[1] }}
                                                </div>
                                                <div class=""
                                                    id="categoryNameInput{{ $key }}a"style="display: none">
                                                    <form action="/admin/doitendanhmuc" method="POST">
                                                        <div class="">
                                                            <div class="d-flex justify-content-end me-5">
                                                                <input type="hidden" name="madanhmuc"
                                                                    value="{{ $item[0] }}">
                                                                <div class="">
                                                                    <input name="tendanhmuc"
                                                                        class="border-light rounded-start p-1"
                                                                        type="text" style="width: 265px"
                                                                        value="{{ $item[1] }}">
                                                                </div>
                                                                <div class="">
                                                                    <button
                                                                        class="btn-green p-1 pe-3 border-light rounded-end"
                                                                        type="submit">Lưu
                                                                    </button>
                                                                </div>
                                                                @csrf
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                @if ($item[2] == 0)
                                                    <a href="/admin/thaydoitrangthaidanhmuc?id={{ $item[0] }}"
                                                        class="btn btn-light ms-2">
                                                        <ion-icon class="fs-5 text-green" name="eye"></ion-icon>
                                                    </a>
                                                @else
                                                    <a href="/admin/thaydoitrangthaidanhmuc?id={{ $item[0] }}"
                                                        class="btn btn-light ms-2">
                                                        <ion-icon class="fs-5 text-danger" name="eye-off"></ion-icon>
                                                    </a>
                                                @endif


                                                <button id="openEditCategory{{ $key }}a" class="btn btn-info mx-2"
                                                    onclick="document.getElementById('categoryNameInput{{ $key }}a').style.display = 'block';document.getElementById('categoryName{{ $key }}a').style.display = 'none';document.getElementById('openEditCategory{{ $key }}a').style.display = 'none';document.getElementById('closeEditCategory{{ $key }}a').style.display = 'block';">Sửa</button>
                                                <button id="closeEditCategory{{ $key }}a"
                                                    class="btn btn-info mx-2"
                                                    onclick="document.getElementById('categoryNameInput{{ $key }}a').style.display = 'none';document.getElementById('categoryName{{ $key }}a').style.display = 'block';document.getElementById('openEditCategory{{ $key }}a').style.display = 'block';document.getElementById('closeEditCategory{{ $key }}a').style.display = 'none';"
                                                    style="display: none">Sửa</button>
                                                <button class="btn btn-danger me-2"
                                                    onclick="document.getElementById('deleteAlert{{ $key }}a').style.display = 'block';">Xóa</button>
                                            </td>
                                            <td class="fs-6 bg-green text-light"></td>
                                            <td class="fs-6 bg-green text-light"></td>
                                            <td class="fs-6 bg-green text-light"></td>
                                        </tr>
                                        {{-- =================== Alert section ==================== --}}
                                        <div class="position-fixed top-30 bg-light" id="deleteAlert{{ $key }}a"
                                            style="display: none; margin-left: 387px; margin-top: -88px; width: 600px; height: 330px; box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset; z-index: 9999;">
                                            <div class="text-center">
                                                <span class="fs-5 text-danger">Xóa danh mục này đồng nghĩa với xóa tất cả
                                                    các loại sản phẩm và sản phẩm của danh mục này</span><br>
                                                <ion-icon class="text-danger" name="alert-circle-outline"
                                                    style="font-size: 145px"></ion-icon><br>
                                                <span class="fs-5">Bạn chắc chắn chứ ?</span>
                                                <div class="mt-3">
                                                    <form action="/admin/xoadanhmuc" method="POST">
                                                        <input type="hidden" name="MaDanhMuc"
                                                            value="{{ $item[0] }}">
                                                        <button type="submit" class="btn btn-lg btn-success mx-5">Xác
                                                            nhận</button>
                                                        <button type="button"
                                                            onclick="document.getElementById('deleteAlert{{ $key }}a').style.display = 'none';"
                                                            class="btn btn-lg btn-danger mx-5">Hủy bỏ</button>
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- ============= End alert section ============== --}}
                                        @foreach ($item[3][0] as $key => $item1)
                                            <div class="position-fixed top-30 bg-light"
                                                id="deleteTypeAlert{{ $item1[0] }}a"
                                                style="display: none; margin-left: 387px; margin-top: -88px; width: 600px; height: 330px; box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset; z-index: 9999;">
                                                <div class="text-center">
                                                    <span class="fs-5 text-danger">Xóa loại sản phẩm này đồng nghĩa với xóa
                                                        tất cả
                                                        các sản phẩm của loại sản phẩm này</span><br>
                                                    <ion-icon class="text-danger" name="alert-circle-outline"
                                                        style="font-size: 145px"></ion-icon><br>
                                                    <span class="fs-5">Bạn chắc chắn chứ ?</span>
                                                    <div class="mt-3">
                                                        <form action="/admin/xoaloaisanpham" method="POST">
                                                            <input type="hidden" name="maloai"
                                                                value="{{ $item1[0] }}">
                                                            <button type="submit" class="btn btn-lg btn-success mx-5">Xác
                                                                nhận</button>
                                                            <button type="button"
                                                                onclick="document.getElementById('deleteTypeAlert{{ $item1[0] }}a').style.display = 'none';"
                                                                class="btn btn-lg btn-danger mx-5">Hủy bỏ</button>
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <tr>
                                                <form action="/admin/chinhsualoai" method="POST">
                                                    <td class="fs-6">
                                                        <select name="madanhmuc" class="form-select border-green"
                                                            aria-label="Default select example"
                                                            id="selectCategoryId{{ $item1[0] }}a"
                                                            style="display: none">
                                                            @foreach ($category as $item2)
                                                                @if ($item1[3] == $item2->MaDanhMuc)
                                                                    <option value="{{ $item2->MaDanhMuc }}" selected>
                                                                        {{ $item2->TenDanhMuc }}</option>
                                                                @else
                                                                    <option value="{{ $item2->MaDanhMuc }}">
                                                                        {{ $item2->TenDanhMuc }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="fs-6">
                                                        <div class="" id="typeNameInput{{ $item1[0] }}a"
                                                            style="display: none">
                                                            <div class="d-flex justify-content-center">
                                                                <div class="">
                                                                    <input name="tenloai" class="border-green rounded p-1"
                                                                        type="text" style="width: 263px"
                                                                        value="{{ $item1[1] }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="" id="saveButton{{ $item1[0] }}a"
                                                            style="display: none">
                                                            <div class="d-flex justify-content-center">
                                                                <button
                                                                    class="btn-green w-50 p-1 pe-3 border-green rounded d-flex justify-content-center"
                                                                    type="submit">Lưu</button>
                                                            </div>
                                                        </div>
                                                        @csrf
                                                    </td>
                                                </form>
                                                <td class="fs-6">{{ $item1[0] }}</td>
                                                <td class="fs-6">{{ $item1[1] }}</td>
                                                <td class="d-flex justify-content-center align-items-center">
                                                    @if ($item1[2] == 0)
                                                        <a href="/admin/thaydoitrangthailoai?id={{ $item1[0] }}"
                                                            class="btn btn-light text-green">
                                                            <ion-icon class="fs-5" name="eye"></ion-icon>
                                                        </a>
                                                    @else
                                                        <a href="/admin/thaydoitrangthailoai?id={{ $item1[0] }}"
                                                            class="btn btn-light text-danger">
                                                            <ion-icon class="fs-5" name="eye-off"></ion-icon>
                                                        </a>
                                                    @endif

                                                    <button id="openEditType{{ $item1[0] }}a"
                                                        class="btn btn-info mx-2"
                                                        onclick="document.getElementById('selectCategoryId{{ $item1[0] }}a').style.display = 'block';document.getElementById('typeNameInput{{ $item1[0] }}a').style.display = 'block';document.getElementById('openEditType{{ $item1[0] }}a').style.display = 'none';document.getElementById('closeEditType{{ $item1[0] }}a').style.display = 'block';document.getElementById('saveButton{{ $item1[0] }}a').style.display = 'block';">Sửa</button>
                                                    <button id="closeEditType{{ $item1[0] }}a"
                                                        class="btn btn-info mx-2"
                                                        onclick="document.getElementById('selectCategoryId{{ $item1[0] }}a').style.display = 'none';document.getElementById('typeNameInput{{ $item1[0] }}a').style.display = 'none';document.getElementById('openEditType{{ $item1[0] }}a').style.display = 'block';document.getElementById('closeEditType{{ $item1[0] }}a').style.display = 'none';document.getElementById('saveButton{{ $item1[0] }}a').style.display = 'none';"style="display: none">Sửa</button>
                                                    <button class="btn btn-danger me-2"
                                                        onclick="document.getElementById('deleteTypeAlert{{ $item1[0] }}a').style.display = 'block';">Xóa</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <form action="/admin/themloai" method="POST">
                                                    <div class="">
                                                        <div class="d-flex justify-content-end me-5">
                                                            <input type="hidden" name="madanhmuc"
                                                                value="{{ $item[0] }}">
                                                            <div class="">
                                                                <input name="tenloai"
                                                                    class="border-green rounded-start p-1" type="text"
                                                                    style="width: 265px">
                                                            </div>
                                                            <div class="">
                                                                <button class="btn-green p-1 pe-3 border-green rounded-end"
                                                                    type="submit">
                                                                    <ion-icon name="add-outline"></ion-icon> Thêm loại
                                                                </button>
                                                            </div>
                                                            @csrf
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive p-0">
                            <table id="categoryTable" class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            Mã danh mục
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7">
                                            &emsp;&emsp;&emsp;&emsp;&emsp;Tên danh mục&emsp;&emsp;&emsp;&emsp;&emsp;
                                        </th>
                                        <th></th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                            Mã loại
                                        </th>
                                        <th class="text-uppercase text-secondary font-weight-bolder opacity-7 ps-2">
                                            Tên loại
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr class="">
                                            <td class="fs-6 bg-green text-light">{{ $item[0] }}</td>
                                            <td class="fs-6 bg-green text-light">
                                                <div class="" id="categoryName{{ $key }}">
                                                    {{ $item[1] }}
                                                </div>
                                                <div class=""
                                                    id="categoryNameInput{{ $key }}"style="display: none">
                                                    <form action="/admin/doitendanhmuc" method="POST">
                                                        <div class="">
                                                            <div class="d-flex justify-content-end me-5">
                                                                <input type="hidden" name="madanhmuc"
                                                                    value="{{ $item[0] }}">
                                                                <div class="">
                                                                    <input name="tendanhmuc"
                                                                        class="border-light rounded-start p-1"
                                                                        type="text" style="width: 265px"
                                                                        value="{{ $item[1] }}">
                                                                </div>
                                                                <div class="">
                                                                    <button
                                                                        class="btn-green p-1 pe-3 border-light rounded-end"
                                                                        type="submit">Lưu
                                                                    </button>
                                                                </div>
                                                                @csrf
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                @if ($item[2] == 0)
                                                    <a href="/admin/thaydoitrangthaidanhmuc?id={{ $item[0] }}"
                                                        class="btn btn-light ms-2">
                                                        <ion-icon class="fs-5 text-green" name="eye"></ion-icon>
                                                    </a>
                                                @else
                                                    <a href="/admin/thaydoitrangthaidanhmuc?id={{ $item[0] }}"
                                                        class="btn btn-light ms-2">
                                                        <ion-icon class="fs-5 text-danger" name="eye-off"></ion-icon>
                                                    </a>
                                                @endif


                                                <button id="openEditCategory{{ $key }}"
                                                    class="btn btn-info mx-2"
                                                    onclick="document.getElementById('categoryNameInput{{ $key }}').style.display = 'block';document.getElementById('categoryName{{ $key }}').style.display = 'none';document.getElementById('openEditCategory{{ $key }}').style.display = 'none';document.getElementById('closeEditCategory{{ $key }}').style.display = 'block';">Sửa</button>
                                                <button id="closeEditCategory{{ $key }}"
                                                    class="btn btn-info mx-2"
                                                    onclick="document.getElementById('categoryNameInput{{ $key }}').style.display = 'none';document.getElementById('categoryName{{ $key }}').style.display = 'block';document.getElementById('openEditCategory{{ $key }}').style.display = 'block';document.getElementById('closeEditCategory{{ $key }}').style.display = 'none';"
                                                    style="display: none">Sửa</button>
                                                <button class="btn btn-danger me-2"
                                                    onclick="document.getElementById('deleteAlert{{ $key }}').style.display = 'block';">Xóa</button>
                                            </td>
                                            <td class="fs-6 bg-green text-light"></td>
                                            <td class="fs-6 bg-green text-light"></td>
                                            <td class="fs-6 bg-green text-light"></td>
                                        </tr>
                                        {{-- =================== Alert section ==================== --}}
                                        <div class="position-fixed top-30 bg-light" id="deleteAlert{{ $key }}"
                                            style="display: none; margin-left: 387px; margin-top: -88px; width: 600px; height: 330px; box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset; z-index: 9999;">
                                            <div class="text-center">
                                                <span class="fs-5 text-danger">Xóa danh mục này đồng nghĩa với xóa tất cả
                                                    các loại sản phẩm và sản phẩm của danh mục này</span><br>
                                                <ion-icon class="text-danger" name="alert-circle-outline"
                                                    style="font-size: 145px"></ion-icon><br>
                                                <span class="fs-5">Bạn chắc chắn chứ ?</span>
                                                <div class="mt-3">
                                                    <form action="/admin/xoadanhmuc" method="POST">
                                                        <input type="hidden" name="MaDanhMuc"
                                                            value="{{ $item[0] }}">
                                                        <button type="submit" class="btn btn-lg btn-success mx-5">Xác
                                                            nhận</button>
                                                        <button type="button"
                                                            onclick="document.getElementById('deleteAlert{{ $key }}').style.display = 'none';"
                                                            class="btn btn-lg btn-danger mx-5">Hủy bỏ</button>
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- ============= End alert section ============== --}}
                                        @foreach ($item[3][0] as $key => $item1)
                                            <div class="position-fixed top-30 bg-light"
                                                id="deleteTypeAlert{{ $item1[0] }}"
                                                style="display: none; margin-left: 387px; margin-top: -88px; width: 600px; height: 330px; box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset; z-index: 9999;">
                                                <div class="text-center">
                                                    <span class="fs-5 text-danger">Xóa loại sản phẩm này đồng nghĩa với xóa
                                                        tất cả
                                                        các sản phẩm của loại sản phẩm này</span><br>
                                                    <ion-icon class="text-danger" name="alert-circle-outline"
                                                        style="font-size: 145px"></ion-icon><br>
                                                    <span class="fs-5">Bạn chắc chắn chứ ?</span>
                                                    <div class="mt-3">
                                                        <form action="/admin/xoaloaisanpham" method="POST">
                                                            <input type="hidden" name="maloai"
                                                                value="{{ $item1[0] }}">
                                                            <button type="submit" class="btn btn-lg btn-success mx-5">Xác
                                                                nhận</button>
                                                            <button type="button"
                                                                onclick="document.getElementById('deleteTypeAlert{{ $item1[0] }}').style.display = 'none';"
                                                                class="btn btn-lg btn-danger mx-5">Hủy bỏ</button>
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <tr>
                                                <form action="/admin/chinhsualoai" method="POST">
                                                    <td class="fs-6">
                                                        <select name="madanhmuc" class="form-select border-green"
                                                            aria-label="Default select example"
                                                            id="selectCategoryId{{ $item1[0] }}"
                                                            style="display: none">
                                                            @foreach ($category as $item2)
                                                                @if ($item1[3] == $item2->MaDanhMuc)
                                                                    <option value="{{ $item2->MaDanhMuc }}" selected>
                                                                        {{ $item2->TenDanhMuc }}</option>
                                                                @else
                                                                    <option value="{{ $item2->MaDanhMuc }}">
                                                                        {{ $item2->TenDanhMuc }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="fs-6">
                                                        <div class="" id="typeNameInput{{ $item1[0] }}"
                                                            style="display: none">
                                                            <div class="d-flex justify-content-center">
                                                                <input type="hidden" name="maloai"
                                                                    value="{{ $item1[0] }}">
                                                                <div class="">
                                                                    <input name="tenloai" class="border-green rounded p-1"
                                                                        type="text" style="width: 263px"
                                                                        value="{{ $item1[1] }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="" id="saveButton{{ $item1[0] }}"
                                                            style="display: none">
                                                            <div class="d-flex justify-content-center">
                                                                <button
                                                                    class="btn-green w-50 p-1 pe-3 border-green rounded d-flex justify-content-center"
                                                                    type="submit">Lưu</button>
                                                            </div>
                                                        </div>
                                                        @csrf
                                                    </td>
                                                </form>
                                                <td class="fs-6">{{ $item1[0] }}</td>
                                                <td class="fs-6">{{ $item1[1] }}</td>
                                                <td class="d-flex justify-content-center align-items-center">
                                                    @if ($item1[2] == 0)
                                                        <a href="/admin/thaydoitrangthailoai?id={{ $item1[0] }}"
                                                            class="btn btn-light text-green">
                                                            <ion-icon class="fs-5" name="eye"></ion-icon>
                                                        </a>
                                                    @else
                                                        <a href="/admin/thaydoitrangthailoai?id={{ $item1[0] }}"
                                                            class="btn btn-light text-danger">
                                                            <ion-icon class="fs-5" name="eye-off"></ion-icon>
                                                        </a>
                                                    @endif

                                                    <button id="openEditType{{ $item1[0] }}"
                                                        class="btn btn-info mx-2"
                                                        onclick="document.getElementById('selectCategoryId{{ $item1[0] }}').style.display = 'block';document.getElementById('typeNameInput{{ $item1[0] }}').style.display = 'block';document.getElementById('openEditType{{ $item1[0] }}').style.display = 'none';document.getElementById('closeEditType{{ $item1[0] }}').style.display = 'block';document.getElementById('saveButton{{ $item1[0] }}').style.display = 'block';">Sửa</button>
                                                    <button id="closeEditType{{ $item1[0] }}"
                                                        class="btn btn-info mx-2"
                                                        onclick="document.getElementById('selectCategoryId{{ $item1[0] }}').style.display = 'none';document.getElementById('typeNameInput{{ $item1[0] }}').style.display = 'none';document.getElementById('openEditType{{ $item1[0] }}').style.display = 'block';document.getElementById('closeEditType{{ $item1[0] }}').style.display = 'none';document.getElementById('saveButton{{ $item1[0] }}').style.display = 'none';"style="display: none">Sửa</button>
                                                    <button class="btn btn-danger me-2"
                                                        onclick="document.getElementById('deleteTypeAlert{{ $item1[0] }}').style.display = 'block';">Xóa</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <form action="/admin/themloai" method="POST">
                                                    <div class="">
                                                        <div class="d-flex justify-content-end me-5">
                                                            <input type="hidden" name="madanhmuc"
                                                                value="{{ $item[0] }}">
                                                            <div class="">
                                                                <input name="tenloai"
                                                                    class="border-green rounded-start p-1" type="text"
                                                                    style="width: 265px">
                                                            </div>
                                                            <div class="">
                                                                <button class="btn-green p-1 pe-3 border-green rounded-end"
                                                                    type="submit">
                                                                    <ion-icon name="add-outline"></ion-icon> Thêm loại
                                                                </button>
                                                            </div>
                                                            @csrf
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {!! $data->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const searchInput = document.getElementById("searchInput");
        const rows = document.querySelectorAll("#categoryTable tbody tr");

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
