@extends('admin.layout_admin')

@section('content')
    @php
        $arr = '';
    @endphp
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6>Khuyến mãi</h6>
                        <form action="/admin/themsanphamchokhuyenmai-luu" method="POST">
                            <div class="d-flex align-items-center">
                                <span class="me-2">Ngày bắt đầu: </span>
                                <div class="form-group m-0">
                                    <input nam type="date" class="form-control" id="date" name="date_start" value="{{$data[3]->NgayBatDau}}">
                                </div>
                                <span class="mx-2">Ngày kết thúc: </span>
                                <div class="form-group m-0">
                                    <input type="date" class="form-control" id="date" name="date_end" value="{{$data[3]->NgayHetHan}}">
                                </div>
                                <span class="fs-6 ms-2 me-2">Phần trăm khuyến mãi:</span>
                                <select name="phantramkm" class="form-select m-0" aria-label="Default select example"
                                    style="width: 120px">
                                    @for ($i = 0; $i <= 100; $i++)
                                        @if ($i == $data[2])
                                            <option selected value="{{ $i }}">{{ $i }}%</option>
                                        @else
                                            <option value="{{ $i }}">{{ $i }}%</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                    </div>
                    <input type="hidden" id="inList" name="inList">
                    <input type="hidden" id="outList" name="outList">
                    <input type="hidden" value="{{ $_GET['id'] }}" name="MaKM">
                    <div class="ms-0 my-4">
                        @if (isset(session()->all()['msg']))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('msg') }}
                            </div>
                        @endif
                        <span></span>
                    </div>

                    <div id="" class="mb-4">
                        <div class="border-green p-1">
                            <span class="text-light p-2 rounded-top bg-green">Sản phẩm đã chọn để thêm vào khuyến
                                mãi</span>

                            <div class="input-group m-3 w-25">
                                <span class="input-group-text" id="basic-addon1">Tìm kiếm: </span>
                                <input type="text" class="form-control" id="search1" placeholder="Username"
                                    aria-label="Username" aria-describedby="basic-addon1"
                                    onkeyup="var input, filter, ul, li, a, i, txtValue;input = document.getElementById('search1');filter = input.value.toUpperCase();ul = document.getElementById('checkedProduct2');li = ul.getElementsByTagName('li');for (i = 0; i < li.length; i++) {a = li[i].getElementsByTagName('a')[0];txtValue = a.textContent || a.innerText;if (txtValue.toUpperCase().indexOf(filter) > -1){li[i].style.display = '';} else {li[i].style.display = 'none';}}">
                            </div>
                            <ul id="checkedProduct2" style="list-style-type: none;">

                            </ul>
                        </div>
                    </div>

                    <div id="" class="mb-4">
                        <div class="p-1" style="border: 3px solid #dc3545">
                            <span class="text-light p-2 rounded-top bg-danger">Sản phẩm đã chọn để loại khỏi khuyến
                                mãi</span>

                            <div class="input-group m-3 w-25">
                                <span class="input-group-text" id="basic-addon1">Tìm kiếm: </span>
                                <input type="text" class="form-control" id="search2" placeholder="Username"
                                    aria-label="Username" aria-describedby="basic-addon1"
                                    onkeyup="var input, filter, ul, li, a, i, txtValue;input = document.getElementById('search2');filter = input.value.toUpperCase();ul = document.getElementById('checkedProduct1');li = ul.getElementsByTagName('li');for (i = 0; i < li.length; i++) {a = li[i].getElementsByTagName('a')[0];txtValue = a.textContent || a.innerText;if (txtValue.toUpperCase().indexOf(filter) > -1){li[i].style.display = '';} else {li[i].style.display = 'none';}}">
                            </div>
                            <ul id="checkedProduct1" style="list-style-type: none;">

                            </ul>
                        </div>
                    </div>

                    <div class="card-body mx-1 px-0 pt-0 pb-2">
                        <div class="border-green p-1">
                            <span class="text-light p-2 rounded-top bg-green">Sản phẩm đã thêm vào khuyến mãi</span>
                        </div>
                        <div class="border-green mb-5">
                            <div class="input-group m-3 w-25">
                                <span class="input-group-text" id="basic-addon1">Tìm kiếm: </span>
                                <input type="text" class="form-control" id="search3" placeholder="Username"
                                    aria-label="Username" aria-describedby="basic-addon1"
                                    onkeyup="var input, filter, ul, li, a, i, txtValue;input = document.getElementById('search3');filter = input.value.toUpperCase();ul = document.getElementById('MyUL2');li = ul.getElementsByTagName('li');for (i = 0; i < li.length; i++) {a = li[i].getElementsByTagName('a')[0];txtValue = a.textContent || a.innerText;if (txtValue.toUpperCase().indexOf(filter) > -1){li[i].style.display = '';} else {li[i].style.display = 'none';}}">
                            </div>
                            <ul id="MyUL2" style="list-style-type: none;">
                                @foreach ($data[0] as $item)
                                    @if ($MaKM == $item->MaKM)
                                        @php
                                            $arr .= $item->MaSP . '|';
                                        @endphp
                                        <li id="xyz{{ $item->MaSP }}">
                                            <a>
                                                <div
                                                    class="mb-2 d-flex border-green rounded p-2 justify-content-between mx-3 my-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="checkbox-wrapper-1 me-2">
                                                            <input name="outProduct" type="checkbox"
                                                                id="xyzz{{ $item->MaSP }}"
                                                                onclick="if(this.checked){ content = document.getElementById('xyz{{ $item->MaSP }}'); console.log(content);parent = document.getElementById('checkedProduct1');parent.appendChild(content.cloneNode(true)); elem = document.getElementById('xyzz{{ $item->MaSP }}'); elem.parentNode.removeChild(elem); document.getElementById('outList').value += '{{ $item->MaSP }}|';}else{elem = document.getElementById('xyz{{ $item->MaSP }}'); elem.parentNode.removeChild(elem);document.getElementById('outList').value = document.getElementById('outList').value.replace('{{ $item->MaSP }}|', '')}" />
                                                        </div>
                                                        <span class="fs-6 border-end pe-2 border-4 border-success"><b
                                                                class="text-green">Mã
                                                                sản phẩm:</b> {{ $item->MaSP }}</span>
                                                        <span class="ms-2 fs-6 border-end pe-2 border-4 border-success"><b
                                                                class="text-green">Hình ảnh:</b> <img style="width: 63px"
                                                                src="{{ asset('/storage/product_imgs/' . $item->TenAnh) }}"
                                                                alt=""></span>
                                                        <span class="ms-2 fs-6 border-end pe-2 border-4 border-success"><b
                                                                class="text-green">Tên sản phẩm:</b>
                                                            {{ $item->TenSP }}</span>
                                                        <span class="ms-2 fs-6 border-end pe-2 border-4 border-success"><b
                                                                class="text-green">Đơn giá:</b> {{ $item->DonGia }}</span>
                                                        <span
                                                            class="ms-2 fs-6 border-end pe-2 border-4 border-success"></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        @php
                            $arr = explode('|', $arr);
                            array_pop($arr);
                        @endphp
                        @foreach ($data[1] as $key => $item1)
                            @foreach ($arr as $item2)
                                @if ($item1->MaSP == $item2)
                                    @php
                                        unset($data[1][$key]);
                                    @endphp
                                @endif
                            @endforeach
                        @endforeach


                        <div class="p-1" style="border: 3px solid #dc3545">
                            <span class="text-light p-2 rounded-top bg-danger">Sản phẩm chưa thêm</span>
                        </div>
                        <div class="" style="border: 3px solid #dc3545; height: 500px; overflow: hidden; overflow-y: scroll;">
                            <div class="input-group m-3 w-25">
                                <span class="input-group-text" id="basic-addon1">Tìm kiếm: </span>
                                <input type="text" class="form-control" id="search4" placeholder="Username"
                                    aria-label="Username" aria-describedby="basic-addon1"
                                    onkeyup="var input, filter, ul, li, a, i, txtValue;input = document.getElementById('search4');filter = input.value.toUpperCase();ul = document.getElementById('MyUL1');li = ul.getElementsByTagName('li');for (i = 0; i < li.length; i++) {a = li[i].getElementsByTagName('a')[0];txtValue = a.textContent || a.innerText;if (txtValue.toUpperCase().indexOf(filter) > -1) {li[i].style.display = '';} else {li[i].style.display = 'none';}}">
                            </div>
                            <ul id="MyUL1" style="list-style-type: none;">
                                @foreach ($data[1] as $item3)
                                    {{-- @if ($MaKM != $item1->MaKM) --}}
                                    <li id="abc{{ $item3->MaSP }}">
                                        <a>
                                            <div class="mb-2 d-flex rounded p-2 justify-content-between mx-3 my-2"
                                                style="border: 3px solid #dc3545">
                                                <div class="d-flex align-items-center">
                                                    <div class="checkbox-wrapper-1 me-2">
                                                        <input name="inProduct" id="abcc{{ $item3->MaSP }}"
                                                            type="checkbox"
                                                            onclick="if(this.checked){ content = document.getElementById('abc{{ $item3->MaSP }}'); console.log(content);parent = document.getElementById('checkedProduct2');parent.appendChild(content.cloneNode(true)); elem = document.getElementById('abcc{{ $item3->MaSP }}'); elem.parentNode.removeChild(elem);document.getElementById('inList').value += '{{ $item3->MaSP }}|'; }else{elem = document.getElementById('abc{{ $item3->MaSP }}'); elem.parentNode.removeChild(elem);document.getElementById('inList').value = document.getElementById('inList').value.replace('{{ $item3->MaSP }}|', '')}" />
                                                    </div>
                                                    <span class="fs-6 border-end pe-2 border-4 border-danger"><b
                                                            class="text-green">Mã
                                                            sản phẩm:</b> {{ $item3->MaSP }}</span>
                                                    <span class="ms-2 fs-6 border-end pe-2 border-4 border-danger"><b
                                                            class="text-green">Hình ảnh:</b> <img style="width: 63px"
                                                            src="{{ asset('/storage/product_imgs/' . $item3->TenAnh) }}"
                                                            alt=""></span>
                                                    <span class="ms-2 fs-6 border-end pe-2 border-4 border-danger"><b
                                                            class="text-green">Tên sản phẩm:</b>
                                                        {{ $item3->TenSP }}</span>
                                                    <span class="ms-2 fs-6 border-end pe-2 border-4 border-danger"><b
                                                            class="text-green">Đơn giá:</b> {{ $item3->DonGia }}</span>
                                                    <span class="ms-2 fs-6 border-end pe-2 border-4 border-danger"></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    {{-- @endif --}}
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="p-4 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success px-5">Lưu</button>
                    </div>
                    @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
