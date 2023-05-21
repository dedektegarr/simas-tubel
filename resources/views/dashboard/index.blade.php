@extends('layouts.app')
@section('content')
    @if (Auth::user()->level == 'pegawai')
        <div class="row">
            <div class="col">
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info mr-2"></i>
                    Anda memiliki {{ $jumlah_rekom }} rekomendasi baru
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        @if (Auth::user()->level == 'admin')
            <div class="col-md-3">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $jumlah_pimpinan }}</h3>
                        <p>Pimpinan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $jumlah_pegawai }}</h3>
                        <p>Pegawai</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endif
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $jumlah_tubel }}</h3>
                    <p>Tubel</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $jumlah_rekom }}</h3>
                    <p>Rekomendasi</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Data Tubel</h3>
                </div>
                <div class="card-body">
                    <canvas id="chart"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 541px;"
                        width="1082" height="500" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        var ctx = document.getElementById('chart');
        const tubelChart = [];

        @foreach ($tubel_chart as $item)
            tubelChart.push({{ $item }});
        @endforeach

        const data = {
            labels: [
                'Tubel Aktif',
                'Tubel Selesai',
            ],
            datasets: [{
                label: 'Jumlah',
                data: tubelChart,
                backgroundColor: [
                    'rgb(40, 167, 69)',
                    'rgb(108, 117, 125)',
                ],
                hoverOffset: 4
            }]
        };

        new Chart(ctx, {
            type: 'pie',
            data: data
        });
    </script>
@endpush
