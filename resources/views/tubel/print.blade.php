<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $page_title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<body>

    <div class="container" style="font-family: 'Times New Roman', Times, serif">
        {{-- COP --}}
        <div class="row align-items-center">
            <div class="col">
                <img src="{{ asset('img/logo-bengkulu.png') }}" alt="Kota Bengkulu.png" class="img-fluid float-right"
                    style="max-width:120px" />
            </div>
            <div class="col-9">
                <div style="transform: translateX(-2rem)">
                    <h3 class="text-center">PEMERINTAHAN PROVINSI BENGKULU</h3>
                    <h2 class="text-center font-weight-bold">BADAN KEPEGAWAIAN DAERAH</h2>
                    <!-- <h1 class="text-center">KELURAHAN TENGAH PADANG</h1> -->
                    <p class="text-center">Alamat: Jl. Pembangunan Bomor 1 Padang Harapan Bengkulu 3825
                        e-mail: sekretariat@bkd. bengkuluprov.go.id
                    </p>
                </div>

            </div>
        </div>

        <div class="line" style="margin-top: 1.2rem">
            {{-- <hr style="border:3px solid #000"> --}}
            <hr style="border:.2px solid #000; margin-top: -15px">
            <hr style="border:.2px solid #000; margin-top: -15px">
        </div>

        @php
            $date = \Carbon\Carbon::now()->locale('id');
        @endphp

        {{-- Tanggal --}}
        <p class="text-right mt-2">Bengkulu, {{ $date->translatedFormat('d M Y') }}</p>

        <div class="text-center my-5">
            <h4 class="text-center d-inline-block" style="border-bottom: 2px solid black; font-weight:bold">LAPORAN
                {{ strtoupper($page_title) }}</h4>
            <p>Nomor :</p>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="15px">No</th>
                    <th>No. SK</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Universitas</th>
                    <th>Jenjang</th>
                    <th>Status</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_tubel as $tubel)
                    <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>{{ $tubel->no_sk }}</td>
                        <td>{{ $tubel->pegawai->nama }}</td>
                        <td>{{ $tubel->pegawai->nip ?? '-' }}</td>
                        <td>{{ $tubel->universitas }}</td>
                        <td>{{ $tubel->jenjang }}</td>
                        <td>{{ $tubel->status }}</td>
                        <td>{{ $tubel->tgl_mulai }}</td>
                        <td>{{ $tubel->tgl_selesai ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row justify-content-end" style="margin: 5rem 0">
            <div class="col-4">
                <div class="ttd">
                    <h4 class="ttd-h4 text-center" style="font-size: 1rem">Plh. KEPALA BADAN KEPEGAWAIAN DAERAH
                        PROVINSI BENGKULU
                        KEPALA BIDANG PENGEMBANGAN APARATUR
                    </h4>
                    <br><br><br>
                    <div class="text-center">
                        <h4
                            style="font-size: 1rem;font-weight:bold; border-bottom: 1px solid black; display:inline-block">
                            RUSMAYADI, S.STP,
                            MM</h4><br>
                        <span>Pembina TK.I</span><br>
                        <span>Nip. 197705061996121001</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        window.print();
    </script>
</body>

</html>
