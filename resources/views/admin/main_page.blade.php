@extends('admin.layout_admin')

@section('content')
    <div class="py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Doanh thu hôm nay</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{number_format($daySum, 0, ',', '.') }}đ
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="d-flex align-items-center justify-content-center text-green icon icon-shape bg-light border-green shadow text-center border-radius-md">
                                    <ion-icon class="fs-4" name="pricetag"></ion-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Doanh thu năm nay</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{number_format($yearSum, 0, ',', '.') }}đ
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="d-flex align-items-center justify-content-center text-green icon icon-shape bg-light border-green shadow text-center border-radius-md">
                                    <ion-icon class="fs-4" name="pricetags"></ion-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Tài khoản ( khách )</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{$accountSum}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="d-flex align-items-center justify-content-center text-green icon icon-shape bg-light border-green shadow text-center border-radius-md">
                                    <ion-icon class="fs-4" name="people"></ion-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Đơn hàng đã xuất</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{$orderSum}}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="d-flex align-items-center justify-content-center text-green icon icon-shape bg-light border-green shadow text-center border-radius-md">
                                    <ion-icon class="fs-4" name="clipboard"></ion-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="">
                <div class="card z-index-2">
                    <div class="card-header pb-0">
                        <h6>Biểu đồ doanh thu theo năm</h6>
                        <form id="myForm" action="/admin" method="POST">
                            <select id="mySelect" class="form-select m-2" name="year" style="width: 101px;">
                                @for ($i = 2023; $i <= date("Y"); $i++)
                                    @if ($i == $year)
                                        <option selected value="{{ $i }}">{{ $i }}</option>
                                    @else
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endif
                                @endfor
                            </select>
                            @csrf
                        </form>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            {{-- <canvas id="chart-line" class="chart-canvas" height="300"></canvas> --}}
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
    <script>
        const form = document.getElementById("myForm");
        const select = document.getElementById("mySelect");
        select.addEventListener("change", function(event) {
            form.submit();
        });

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8',
                    'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                ],
                datasets: [{
                    label: 'Doanh thu năm {{ $year }}',
                    data: ["{{$data[0][0]}}"," {{$data[1][0]}}"," {{$data[2][0]}}"," {{$data[3][0]}}"," {{$data[4][0]}}"," {{$data[5][0]}}"," {{$data[6][0]}}"," {{$data[7][0]}}"," {{$data[8][0]}}"," {{$data[9][0]}}"," {{$data[10][0]}}"," {{$data[11][0]}}"],
                    backgroundColor: 'rgb(1 198 140)',
                    borderColor: 'rgb(3, 107, 90)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
