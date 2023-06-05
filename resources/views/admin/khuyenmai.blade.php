<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="/admin/themkhuyenmai" method="POST">
        <input type="text" name="PhanTramKM" placeholder="PhanTramKM">
        <input type="date" name="NgayBatDau" placeholder="NgaybatDau">
        <input type="date" name="NgayKetThuc" placeholder="NgayKetThuc">
        @foreach ($data as $key=>$item)
            <input type="checkbox" id="" name="selectedProducts{{$key}}" value="{{$item->MaSP}}">
            <label for="selectedProducts{{$key}}"> {{$item->TenSP}}</label><br>
            @php
                $productQuantity = $key;
            @endphp
        @endforeach
        @csrf
        <input type="hidden" name="productQuantity" value="{{$productQuantity}}">
        <button type="submit">Lưu</button>
    </form>
</body>

</html>
