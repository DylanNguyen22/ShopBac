@extends('client.layout')

@section('content')
    <style>
        img {
            width: 100%;
            display: block;
        }

        .img-display {
            overflow: hidden;
        }

        .img-showcase {
            display: flex;
            width: 100%;
            transition: all 0.5s ease;
        }

        .img-showcase img {
            min-width: 100%;
        }

        .img-select {
            display: flex;
        }

        .img-item {
            margin: 0.3rem;
        }

        .img-item:nth-child(1),
        .img-item:nth-child(2),
        .img-item:nth-child(3) {
            margin-right: 0;
        }

        .img-item:hover {
            opacity: 0.8;
        }

        @media screen and (min-width: 992px) {
            .card {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                grid-gap: 1.5rem;
            }

            .card-wrapper {
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .product-imgs {
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .product-content {
                padding-top: 0;
            }
        }
    </style>
    <div class="" style="margin: 0 200px">
        <div class="d-flex mt-5">

            <div class="shadow p-2 rounded" style="width: 45%">
                <div class="product-imgs">
                    <div class="img-display">
                        <div class="img-showcase">
                            @foreach ($data[2] as $img)
                                <img src="{{ asset('/storage/product_imgs/' . $img->TenAnh) }}" alt="shoe image">
                            @endforeach
                        </div>
                    </div>
                    <div class="img-select" id="img-select">
                        @foreach ($data[2] as $key => $img)
                            <div class="img-item">
                                <a href="#" data-id="{{ $key + 1 }}">
                                    <img src="{{ asset('/storage/product_imgs/' . $img->TenAnh) }}" alt="shoe image">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mx-5">
                <span class="fs-3">{{ $data[4]->TenSP }}</span><br>
                @if ($data[5] <= 0)
                    <span class="ms-4 fs-4 text-green fw-bold ms-2">{{ number_format($data[4]->DonGia, 0, ',', '.') }}
                        ₫</span>
                @else
                    <span
                        class="ms-4 fs-4 text-green fw-bold ms-4">{{ number_format(($data[4]->DonGia / 100) * (100 - $data[5]), 0, ',', '.') }}
                        ₫</span>
                    <span
                        class="ms-4 fs-4 text-danger fw-bold text-decoration-line-through ms-2">{{ number_format($data[4]->DonGia, 0, ',', '.') }}
                        ₫</span>
                @endif

                <ul class="fs-5" style="list-style: inside;">
                    <li class="mb-3">Chất liệu bạc cao cấp</li>
                    <li class="mb-3">Shop thay đổi màu đá miễn phí theo mệnh</li>
                    <li class="mb-3">Bảo hành miễn phí trọn đời đánh bóng làm mới hoặc rơi đá</li>
                    <li class="mb-3">Miễn phí khắc tên và tặng kèm hộp đựng sản phẩm sang trọng</li>
                </ul>

                <span class="fs-5 ms-4"><b>SKU: </b>{{ $data[4]->MaTraCuu }}</span>

                <div class="">
                    <form action="/donhang/muangay" method="POST">
                        @if ($data[4]->LoaiKichThuoc == 1)
                            <div class="d-flex mt-4 align-items-center">
                                <span class="fs-5">Size nam: </span>
                                <select name="KichThuocNam" class="form-select ms-1" style="width: 12%;"
                                    aria-label="Default select example">
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
                            </div>
                        @endif
                        @if ($data[4]->LoaiKichThuoc == 2)
                            <div class="d-flex mt-4 align-items-center">
                                <span class="fs-5">Size nữ: </span>
                                <select name="KichThuocNu" class="form-select ms-1" style="width: 12%;"
                                    aria-label="Default select example">
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
                            </div>
                        @endif
                        @if ($data[4]->LoaiKichThuoc == 3)
                            <div class="d-flex mt-4 align-items-center">
                                <span class="fs-5">Size nam: </span>
                                <select name="KichThuocNam" class="form-select ms-1" style="width: 12%;"
                                    aria-label="Default select example">
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

                                <span class="fs-5 ms-3">Size nữ: </span>
                                <select name="KichThuocNu" class="form-select ms-1" style="width: 12%;"
                                    aria-label="Default select example">
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
                            </div>
                        @endif
                        <div class="ms-4 mt-2 text-green">
                            @if ($data[4]->SoLuong > 0)
                                <span>Còn hàng: {{ $data[4]->SoLuong }}</span>
                            @else
                                <span>Hết hàng</span>
                            @endif
                        </div>

                        @if ($data[4]->SoLuong > 0)
                            <div class="ms-4 mt-2 d-flex align-items-center">
                                <input type="hidden" id="Quantity" value="{{ $data[4]->SoLuong }}">
                                <button type="button" class="btn btn-primary" onclick="increase()">+</button>
                                <span class="mx-2" id="orderQuantity">1</span>
                                <input type="hidden" id="inputQuantity1" name="SoLuong" value="1">
                                <button type="button" class="btn btn-primary" onclick="decrease()">-</button>

                                @if ($data[5] > 0)
                                    <input type="hidden" name="GiaTien"
                                        value="{{ ($data[4]->DonGia / 100) * (100 - $data[5]) }}">
                                @else
                                    <input type="hidden" name="GiaTien" value="{{ $data[4]->DonGia }}">
                                @endif
                                <input type="hidden" id="inputQuantity2" name="SoLuong" value="1">
                                <input type="hidden" name="MaSP" value="{{ $data[4]->MaSP }}">
                                <button id="btn1" type="submit" class="btn btn-danger mx-2">Mua ngay</button>
                                @csrf
                    </form>

                    <div class="">
                        <form action="/giohang/themvaogiohang" method="POST">
                            <input type="hidden" name="ProductId" value="{{ $data[4]->MaSP }}">
                            <input type="hidden" name="Price" value="{{ $data[4]->DonGia }}">
                            <button id="btn2" class="btn btn-success" class="btn btn-success">Thêm vào giỏ
                                hàng</button>
                            @csrf
                        </form>
                    </div>
                </div>
                    @endif
            </div>

        </div>
    </div>
    <div class="mt-3">
        <button class="fs-5" style="border: none; background: none" id="button1" onclick="close_description()">
            Mô tả &#9650;
        </button>

        <button class="fs-5" style="border: none; display: none" id="button2" style="display: none"
            onclick="open_description()">
            Mô tả &#9660;
        </button>
        <div id="content" style="overflow: hidden; width: 80% ">
            <hr>
            <div>
                <span class="fs-4 fw-bold">Giới thiệu sản phẩm {{ $data[4]->TenSP }}</span>
                <p style="white-space: pre-line;">
                    {{ $data[4]->MoTa }}
                </p>
                <p> <span style="font-weight: bolder">- Thông tin chi tiết về sản phẩm:</span></p>

                <p style="white-space: pre-line;">
                    {{ $data[4]->ChiTiet }}
                </p>

                <span class="fs-5 fw-bold">Hình ảnh chi tiết của {{ $data[4]->TenSP }}</span>
                @php
                    echo "".$data[4]->Video;
                @endphp
                @foreach ($data[2] as $img)
                    <p class="">
                        <img style="width: 100%" src="{{ asset('/storage/product_imgs/' . $img->TenAnh) }}"
                            alt="Nhẫn đôi bạc nhẫn cặp bạc đẹp ND0176">
                    </p>
                @endforeach
                <h2>
                    <strong>
                        <strong class="">Quy trình thiết kế và sản xuất nhẫn đôi bạc Trang Sức
                            TNJ</strong>
                    </strong>
                </h2>
                <p>
                    <strong class=""><a href="#">Nhẫn đôi bạc</a></strong> <span>đẹp ND0176
                        được thiết kế với quy trình khép kín với máy móc hiện đại cùng đội ngũ thợ kim hoàn
                        lành nghề có nhiều năm kinh nghiệm đam mê với nghề</span>

                </p>
                <p class="">
                    <img style="width: 100%" src="/assets/product-imgs/quy-trinh-san-xuat-trang-suc-tnj-10.jpg"
                        alt="Nhẫn đôi bạc nhẫn cặp bạc đẹp ND0176">
                </p>
                <p>
                    <img style="width: 100%"
                        src="/assets/product-imgs/khac-ten-theo-yeu-cau-tren-cong-nghe-laser-hien-dai-1 .jpg"
                        alt="Nhẫn đôi bạc nhẫn cặp bạc đẹp ND0176">
                </p>
                <p>
                    <img style="width: 100%" src="/assets/product-imgs/anh-cua-hang-trang-suc-TNJ1-1.jpg"
                        alt="Nhẫn đôi bạc nhẫn cặp bạc đẹp ND0176">
                </p>
                <p>
                    <img style="width: 100%" src="/assets/product-imgs/anh-cua-hang-trang-suc-TNJ1.jpg"
                        alt="Nhẫn đôi bạc nhẫn cặp bạc đẹp ND0176">
                </p>
                <p>
                    <strong>Hướng dẫn cách đo size nhẫn:</strong>
                </p>
                <p>
                    <strong>Cách 1:</strong>
                    Nếu có một chiếc nhẫn khác để đo, cách chính xác nhất là bạn dùng một chiếc nhẫn có độ
                    rộng và kiểu
                    dáng
                    tương tự bạn định mua và làm theo các bước:
                </p>
                <p>Bước 1: Quý khách dùng thước để đo đường kính bên trong của chiếc nhẫn.</p>
                <p>
                    <img style="width: 100%" src="/assets/product-imgs/do-duong-kinh-ben-trong-nhan.jpg"
                        alt="Nhẫn đôi bạc nhẫn cặp bạc đẹp ND0176">
                </p>
                <p>Bước 2: Quý khách đối chiếu số mm của thước với kích thước đường kính của những ni nhẫn
                    sau.</p>
                <p>Bước 3: Size nhẫn của bạn chính là ký tự ghi trên vòng tròn của ảnh bên dưới</p>
                <p>
                    <img style="width: 100%" src="/assets/product-imgs/bang-size-nhan-chuan.jpg"
                        alt="Nhẫn đôi bạc nhẫn cặp bạc đẹp ND0176">
                </p>
                <p>
                    <strong>Cách 2:</strong>
                </p>
                <p>
                    Lấy một sợi dây chỉ mảnh hoặc mảnh giấy nhỏ hình chữ nhật (Như hình ), quấn quanh ngón
                    tay cần đeo
                    nhẫn,
                    đánh dấu, sau đó duổi thẳng sợi dây và dùng thước kẻ đo chính xác từng mm. Trường hợp
                    xương khớp
                    ngón
                    tay của bạn to, thì bạn nên đo chu vi ở gần khớp dưới (không phải trên khớp) Sao cho khi
                    đeo nhẫn dễ
                    vào
                    nhưng không bị tuột mất. Sau đó lấy số mm đo được chia cho 3.14 ra được kết quả đường
                    kính chiếc
                    nhẫn và
                    đối chiếu với bảng size bên trên.
                </p>
                <p>
                    <img style="width: 100%" src="/assets/product-imgs/do-size-tay-chuan-1.png"
                        alt="Nhẫn đôi bạc nhẫn cặp bạc đẹp ND0176">
                </p>
                <p>
                    <strong>Cách 3:</strong>
                    Tính ni tay theo chiều cao và cân nặng
                </p>
                <p>
                    <img style="width: 100%" src="/assets/product-imgs/huongdan5.jpg"
                        alt="Nhẫn đôi bạc nhẫn cặp bạc đẹp ND0176">
                </p>
                <p>
                    <img style="width: 100%" src="/assets/product-imgs/huongdan6.jpg"
                        alt="Nhẫn đôi bạc nhẫn cặp bạc đẹp ND0176">
                </p>
                <h2>Hộp đựng sản phẩm sang trọng đi kèm</h2>
                <p>
                    <img style="width: 100%" src="/assets/product-imgs/hop-dung-san-pham-trang-suc-tnj.jpg"
                        alt="Nhẫn đôi bạc nhẫn cặp bạc đẹp ND0176">
                </p>
                <p>
                    <strong>Nhẫn đôi bạc nhẫn cặp bạc đẹp ND0176</strong>
                    chắc chắn sẽ làm 2 bạn hài lòng. Liên hệ ngay với TNJ qua Hotline/Zalo: 00000000 luôn hỗ
                    trợ bạn!
                </p>
                <p>Địa chỉ: Demo</p>
            </div>
        </div>
        <button class="fs-5" style="border: none; background: none" id="open_button" onclick="open_productDetail()">
            Chi tiết sản phẩm &#9660;
        </button>

        <button class="fs-5" style="border: none; display: none" id="close_button" style="display: none"
            onclick="close_productDetail()">
            Chi tiết sản phẩm &#9650;
        </button>
        <div id="content1" style="height: 0px; overflow: hidden;">
            <hr>

            {{-- <h2>Chi tiết sản phẩm</h2> --}}
            <div>
                <span class="fs-6 fw-bold">Thương hiệu</span>
                <a class="text-decoration-none text-green" href="/">
                    <span>Trang sức Tnj</span>
                </a>
            </div>
            <div>
                <span class="fs-6 fw-bold">Tham chiếu</span>
                <span>{{ $data[4]->MaTraCuu }}</span>
            </div>
            <div>
                <span class="fs-6 fw-bold">Còn hàng</span>
                <span>{{ $data[4]->SoLuong }}</span>
            </div>
            <section>
                <h3>Thông tin chi tiết</h3>
                <table style="width: 90%;padding: 10px">
                    <tr>
                        <td>Thương hiệu</td>
                        <td>TNJ</td>
                    </tr>
                    <tr>
                        <td>Mã sản phẩm</td>
                        <td>{{ $data[4]->MaTraCuu }}</td>
                    </tr>
                    <tr>
                        <td>
                            Chất liệu
                        </td>
                        <td>
                            {{ $data[6] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Khắc Tên + Số
                        </td>
                        <td>
                            Khắc tên trên công nghệ Laser hiện đại
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Kiểu Dáng
                        </td>
                        <td>
                            Kiểu Dáng
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Bảo Hành
                        </td>
                        <td>
                            Miễn phí trọn đời đánh bóng làm mới hoặc rơi đá
                        </td>
                    </tr>
                </table>
            </section>
        </div>
    </div>
    <div class="products_list_selling_title d-flex justify-content-between align-items-center my-3 mx-3">
        <span class="fs-5 fw-bold">Sản phẩm cùng danh mục</span>
        <a href="" class="fs-6">Xem tất cả</a>
    </div>
    <div class="products_list_items d-flex">
        @foreach ($data[7] as $item)
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
                </a>
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
                        <div class="d-flex justify-content-between">
                            <form action="/giohang/themvaogiohang" method="POST">
                                <input type="hidden" name="ProductId" value="{{ $item['MaSP'] }}">
                                <input type="hidden" name="Price" value="{{ $item['DonGia'] }}">
                                <button class="btn btn-success p-1">Thêm vào giỏ hàng</button>
                                @csrf
                            </form>
                            <form action="/donhang/muangay" method="POST">
                                <input type="hidden" value="{{ $item['DonGia'] }}" name="GiaTien">
                                <input type="hidden" value="{{ $item['MaSP'] }}" name="MaSP">
                                <button type="submit" class="btn btn-danger p-1">Mua ngay</button>
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
                        <div class="d-flex justify-content-between">
                            <form action="/giohang/themvaogiohang" method="POST">
                                <input type="hidden" name="ProductId" value="{{ $item['MaSP'] }}">
                                <input type="hidden" name="Price" value="{{ $item['PhanTramKM'] }}">
                                <div class="">
                                    <button class="btn btn-success p-1">Thêm vào giỏ hàng</button>
                                </div>
                                @csrf
                            </form>

                            <form action="/donhang/muangay" method="POST">
                                <input name="GiaTien" type="hidden"
                                    value="{{ $item['DonGia'] - ($item['DonGia'] / 100) * $item['PhanTramKM'] }}">
                                <input name="MaSP" type="hidden" value="{{ $item['MaSP'] }}">
                                <div class="">
                                    <button type="submit" class="btn btn-danger p-1">Mua ngay</button>
                                </div>
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
    <script>
        const imgs = document.querySelectorAll('#img-select a');
        const imgBtns = [...imgs];
        let imgId = 1;

        imgBtns.forEach((imgItem) => {
            imgItem.addEventListener('click', (event) => {
                event.preventDefault();
                imgId = imgItem.dataset.id;
                slideImage();
            });
        });

        function slideImage() {
            const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

            document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
        }

        window.addEventListener('resize', slideImage);

        function increase() {
            quantity = document.getElementById("Quantity").value;
            inputQuantity = document.getElementById("inputQuantity1").value;
            quantity = Number(quantity);
            inputQuantity = Number(inputQuantity);
            ++inputQuantity;
            if (inputQuantity <= quantity) {
                document.getElementById("orderQuantity").innerHTML = inputQuantity;
                document.getElementById("inputQuantity1").value = inputQuantity;
                document.getElementById("inputQuantity2").value = inputQuantity;
            }
        }

        function decrease() {
            quantity = document.getElementById("Quantity").value;
            inputQuantity = document.getElementById("inputQuantity1").value;
            quantity = Number(quantity);
            inputQuantity = Number(inputQuantity);
            --inputQuantity;
            if (inputQuantity >= 1) {
                document.getElementById("orderQuantity").innerHTML = inputQuantity;
                document.getElementById("inputQuantity1").value = inputQuantity;
                document.getElementById("inputQuantity2").value = inputQuantity;
            }
        }

        function open_description() {
            document.getElementById('content').style.transition = '0.2s'
            document.getElementById('content').style.height = '100%'
            document.getElementById('button2').style.display = 'none'
            document.getElementById('button1').style.display = 'block'
            ocument.getElementById("button1_title").innerHTML = "Paragraph changed.";

        }

        function close_description() {
            document.getElementById('content').style.transition = '0.2s'
            document.getElementById('content').style.height = '0px'
            document.getElementById('button1').style.display = 'none'
            document.getElementById('button2').style.display = 'block'
        }

        function open_productDetail() {
            document.getElementById('content1').style.transition = '0.2s'
            document.getElementById('content1').style.height = '100%'
            document.getElementById('close_button').style.display = 'block'
            document.getElementById('open_button').style.display = 'none'
            ocument.getElementById("button1_title").innerHTML = "Paragraph changed.";
        }

        function close_productDetail() {
            document.getElementById('content1').style.transition = '0.2s'
            document.getElementById('content1').style.height = '0px'
            document.getElementById('open_button').style.display = 'block'
            document.getElementById('close_button').style.display = 'none'
        }
    </script>
@endsection
