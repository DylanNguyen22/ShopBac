@extends('client.layout')

@section('content')
    <div class="container m-5">
        <div class="d-flex flex-wrap">
            @foreach ($product as $item)
                <div class="item_card mx-3 mb-4">
                    <a href="chitietsanpham?id={{ $item['MaSP'] }}" class="text-decoration-none text-dark fw-bold">
                        <div class="item_card_img d-flex align-items-center">
                            <img class="w-100 h-auto" src="{{ asset('/storage/product_imgs/' . $item['TenAnh']) }}"
                                alt="">
                        </div>
                        <div class="item_card_name my-2">
                            <span
                                style="display: block;display: -webkit-box;height: 16px*1.3*3;line-height: 1.3;-webkit-line-clamp: 1;  /* số dòng hiển thị */-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;}">{{ $item['TenSP'] }}</span>
                        </div>
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
                            <input name="GiaTien" type="hidden" value="{{ $item['PhanTramKM'] }}">
                            <input name="MaSP" type="hidden" value="{{ $item['MaSP'] }}">
                            <button type="submit" class="btn btn-danger">Mua ngay</button>
                            @csrf
                        </form>
                    </div>
            @endif
        </div>
        @endforeach
    </div>
    {!! $product->links() !!}
    </div>
@endsection
