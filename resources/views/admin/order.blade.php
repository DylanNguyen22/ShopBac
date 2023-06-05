@extends('admin.layout_admin')

@section('content')
    @php
        $arrStatus = [['2', 'Đã xác nhận', 'text-success'], ['3', 'Đã giao cho đơn vị vận chuyển', 'text-warning'], ['4', 'Giao hàng thành công', 'text-success fw-bold'], ['5', 'Đã hủy', 'text-danger'], ['6', 'Giao hàng không thành công', 'text-danger fw-bold']];
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
                    <div class="card-header pb-0">
                        <h6>Đơn hàng</h6>
                    </div>
                    <div class="ms-0 my-4">
                        @if (isset(session()->all()['msg']))
                            <div class="alert alert-success" role="alert">
                                {{ session()->get('msg') }}
                            </div>
                        @endif
                        <div class="mx-4">
                            <form action="/admin/donhang" id="myForm" method="GET">
                                <select class="form-select border-green" aria-label="Default select example" id="mySelect"
                                    name="TrangThai" style="width: 236px;">
                                    <option value="0">Trạng thái</option>
                                    <option value="1">Đang chờ xác nhận</option>
                                    <option value="2">Đã xác nhận</option>
                                    <option value="3">Đã giao cho đơn vị vận chuyển</option>
                                    <option value="4">Giao hàng thành công</option>
                                    <option value="6">Giao hàng không thành công</option>
                                    <option value="5">Đã hủy</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="card-body mx-1 px-0 pt-0 pb-2">
                        @foreach ($data[0] as $key => $item)
                            <div class="mb-2 d-flex border-green rounded p-2 mx-5 justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span class="fs-6 border-end pe-2 border-4 border-success"><b class="text-green">Mã đặt
                                            hàng:
                                        </b> {{ $item[0] }}</span>
                                    <span class="fs-6 border-end ms-2 pe-2 border-4 border-success"><b
                                            class="text-green">Ngày đặt:</b> {{ $item[1] }}</span>
                                    <span class="ms-2 fs-6 border-end pe-2 border-4 border-success"><b
                                            class="text-green">Tổng giá:</b> {{ $item[2] }}</span>
                                    <span class="ms-2 fs-6 border-end pe-2 border-4 border-success"><b
                                            class="text-green">Tên:</b> {{ $item[7] }}</span>
                                    <span class="ms-2 fs-6 border-end pe-2 border-4 border-success"><b class="text-green">Số
                                            điện thoại: </b>{{ $item[6] }}
                                    </span>
                                    <span class="ms-2 fs-6 border-end pe-2 border-4 border-success"><b
                                            class="text-green">Loại thanh toán: </b>
                                        @if ($item[3] == 2)
                                            Đã thanh toán
                                        @else
                                            Chưa thanh toán
                                        @endif
                                    </span>
                                    <span class="ms-2 fs-6 border-end pe-2 border-4 border-success">
                                        <form action="/admin/thaydoitrangthaidonhang" id="myForm{{ $key }}"
                                            method="POST">
                                            <input type="hidden" name="MaDH" value="{{ $item[5] }}" id="">
                                            @if ($item[4] == 1)
                                                <span class="text-danger">&ensp;&emsp;&emsp;Đang chờ xác
                                                    nhận&ensp;&emsp;&emsp;</span>
                                            @else
                                                <select class="form-select border-green" aria-label="Default select example"
                                                    id="mySelect{{ $key }}" name="TrangThai">
                                                    @foreach ($arrStatus as $item1)
                                                        @if ($item[4] == $item1[0])
                                                            <option class="{{ $item1[2] }}" selected
                                                                value="{{ $item1[0] }}">{{ $item1[1] }}
                                                            </option>
                                                            <script>
                                                                document.getElementById("mySelect{{ $key }}").className = "form-select border-green {{ $item1[2] }}";
                                                            </script>
                                                        @else
                                                            <option class="{{ $item1[2] }}"
                                                                value="{{ $item1[0] }}">{{ $item1[1] }}</option>
                                                        @endif

                                                        <script>
                                                            const form{{ $key }} = document.getElementById("myForm{{ $key }}");
                                                            const select{{ $key }} = document.getElementById("mySelect{{ $key }}");
                                                            select{{ $key }}.addEventListener("change", function(event) {
                                                                form{{ $key }}.submit();
                                                            });
                                                        </script>
                                                    @endforeach
                                                </select>
                                            @endif
                                            @csrf
                                        </form>
                                    </span>
                                    <span class="ms-3">
                                        <a class="fs-6 text-green fw-bold" href="chitietdonhang?id={{ $item[5] }}">Chi
                                            tiết</a>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                        <div class="mx-5">
                            @if (isset($paged))
                                {!! $data[0]->links() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const form = document.getElementById("myForm");
            const select = document.getElementById("mySelect");
            select.addEventListener("change", function(event) {
                form.submit();
            });
        </script>
    @endsection
