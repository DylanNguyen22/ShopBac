@extends('client/layout')

@section('content')
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/web-imgs/ads-1.png') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/web-imgs/ads-2.png') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/web-imgs/ads-3.png') }}" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="products_list">
        <div class="products_list_selling">
            <div class="products_list_selling_title d-flex justify-content-between align-items-center my-3 mx-5">
                <span class="fs-4">Sản phẩm bán chạy</span>
                <a href="" class="fs-6">Xem tất cả</a>
            </div>
            <div class="products_list_items d-flex">
                @foreach ($data[4] as $item)
                    <div class="item_card mx-3">
                        <a href="chitietsanpham?id={{ $item['MaSP'] }}" class="text-decoration-none text-dark fw-bold">
                            <div class="item_card_img d-flex align-items-center">
                                <img class="w-100 h-auto" src="{{ asset('/storage/product_imgs/' . $item['TenAnh']) }}"
                                    alt="">
                            </div>
                            <div class="item_card_name my-2">
                                <span
                                    style="display: block;display: -webkit-box;height: 16px*1.3*3;line-height: 1.3;-webkit-line-clamp: 1;  /* số dòng hiển thị */-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;}">{{ $item['TenSP'] }}</span>
                            </div>
                            @if ($item['SoLuong'] == 0)
                                <div class="d-flex justify-content-center text-secondary">
                                    <span class="fw-bold fs-5">HẾT HÀNG</span>
                                </div>
                            @else
                                @if ($item['PhanTramKM'] == $item['DonGia'])
                                    <div class="item_card_price d-flex">
                                        <div class="item_card_new_price me-2">
                                            <span>{{ number_format($item['DonGia'], 0, ',', '.') }} ₫</span>
                                        </div>
                                    </div>
                        </a>
                        <div class="item_card_bottom d-flex justify-content-between">
                            <form action="/giohang/themvaogiohang" method="POST">
                                <input type="hidden" name="ProductId" value="{{ $item['MaSP'] }}">
                                <input type="hidden" name="Price" value="{{ $item['DonGia'] }}">
                                <button class="btn btn-success">Thêm vào giỏ hàng</button>
                                @csrf
                            </form>
                            <form action="/donhang/muangay" method="POST">
                                <input type="hidden" value="{{ $item['DonGia'] }}" name="GiaTien">
                                <input type="hidden" value="{{ $item['MaSP'] }}" name="MaSP">
                                <button type="submit" class="btn btn-danger">Mua ngay</button>
                                @csrf
                            </form>
                        </div>
                    @else
                        <div class="item_card_price d-flex">
                            <div class="item_card_new_price me-2">
                                <span>{{ number_format($item['PhanTramKM'], 0, ',', '.') }} ₫</span>
                            </div>
                            <div class="item_card_old_price">
                                <span
                                    class="text-decoration-line-through text-danger fw-bold">{{ number_format($item['DonGia'], 0, ',', '.') }}
                                    ₫</span>
                            </div>
                        </div>
                        <div class="item_card_bottom d-flex justify-content-between">
                            <form action="/giohang/themvaogiohang" method="POST">
                                <input type="hidden" name="ProductId" value="{{ $item['MaSP'] }}">
                                <input type="hidden" name="Price" value="{{ $item['PhanTramKM'] }}">
                                <button class="btn btn-success">Thêm vào giỏ hàng</button>
                                @csrf
                            </form>
                            <form action="/donhang/muangay" method="POST">
                                <input name="GiaTien" type="hidden"
                                    value="{{ $item['DonGia'] - ($item['DonGia'] / 100) * $item['PhanTramKM'] }}">
                                <input name="MaSP" type="hidden" value="{{ $item['MaSP'] }}">
                                <button type="submit" class="btn btn-danger">Mua ngay</button>
                                @csrf
                            </form>
                        </div>
                @endif
                @endif
            </div>
            @endforeach
        </div>
    </div>
    {{-- ===================================== --}}
    <div class="products_list_selling">
        <div class="products_list_selling_title d-flex justify-content-between align-items-center my-3 mx-5">
            <span class="fs-4">Hàng mới về</span>
            <a href="" class="fs-6">Xem tất cả</a>
        </div>
        <div class="products_list_items d-flex">
            @foreach ($data[2] as $item)
                <div class="item_card mx-3">
                    <a href="chitietsanpham?id={{ $item['MaSP'] }}" class="text-decoration-none text-dark fw-bold">
                        <div class="item_card_img d-flex align-items-center">
                            <img class="w-100 h-auto" src="{{ asset('/storage/product_imgs/' . $item['TenAnh']) }}"
                                alt="">
                        </div>
                        <div class="item_card_name my-2">
                            <span
                                style="display: block;display: -webkit-box;height: 16px*1.3*3;line-height: 1.3;-webkit-line-clamp: 1;  /* số dòng hiển thị */-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;}">{{ $item['TenSP'] }}</span>
                        </div>
                        @if ($item['SoLuong'] == 0)
                            <div class="d-flex justify-content-center text-secondary">
                                <span class="fw-bold fs-5">HẾT HÀNG</span>
                            </div>
                        @else
                            @if ($item['PhanTramKM'] == $item['DonGia'])
                                <div class="item_card_price d-flex">
                                    <div class="item_card_new_price me-2">
                                        <span>{{ number_format($item['DonGia'], 0, ',', '.') }} ₫</span>
                                    </div>
                                </div>
                    </a>
                    <div class="item_card_bottom d-flex justify-content-between">
                        <form action="/giohang/themvaogiohang" method="POST">
                            <input type="hidden" name="ProductId" value="{{ $item['MaSP'] }}">
                            <input type="hidden" name="Price" value="{{ $item['DonGia'] }}">
                            <button class="btn btn-success">Thêm vào giỏ hàng</button>
                            @csrf
                        </form>
                        <form action="/donhang/muangay" method="POST">
                            <input type="hidden" value="{{ $item['DonGia'] }}" name="GiaTien">
                            <input type="hidden" value="{{ $item['MaSP'] }}" name="MaSP">
                            <button type="submit" class="btn btn-danger">Mua ngay</button>
                            @csrf
                        </form>
                    </div>
                @else
                    <div class="item_card_price d-flex">
                        <div class="item_card_new_price me-2">
                            <span>{{ number_format($item['PhanTramKM'], 0, ',', '.') }} ₫</span>
                        </div>
                        <div class="item_card_old_price">
                            <span
                                class="text-decoration-line-through text-danger fw-bold">{{ number_format($item['DonGia'], 0, ',', '.') }}
                                ₫</span>
                        </div>
                    </div>
                    <div class="item_card_bottom d-flex justify-content-between">
                        <form action="/giohang/themvaogiohang" method="POST">
                            <input type="hidden" name="ProductId" value="{{ $item['MaSP'] }}">
                            <input type="hidden" name="Price" value="{{ $item['PhanTramKM'] }}">
                            <button class="btn btn-success">Thêm vào giỏ hàng</button>
                            @csrf
                        </form>
                        <form action="/donhang/muangay" method="POST">
                            <input name="GiaTien" type="hidden"
                                value="{{ $item['DonGia'] - ($item['DonGia'] / 100) * $item['PhanTramKM'] }}">
                            <input name="MaSP" type="hidden" value="{{ $item['MaSP'] }}">
                            <button type="submit" class="btn btn-danger">Mua ngay</button>
                            @csrf
                        </form>
                    </div>
            @endif
            @endif
        </div>
        @endforeach
    </div>
    </div>
    </div>
@endsection

{{-- {{ asset('assets/web-imgs/ads1.png') }} --}}
