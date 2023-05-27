@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $page_title }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('laporan.cetakTubel') }}" target="_blank" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="jenis_tubel">Jenis Tubel</label>
                            <select name="jenis_tubel" id="jenis_tubel"
                                class="form-control @error('jenis_tubel') is-invalid @enderror">
                                <option value="">Pilih Jenis</option>
                                <option value="mtbt">Mandiri Tidak Berhenti Tugas</option>
                                <option value="mbt">Mandiri Berhenti Tugas</option>
                                <option value="pk">Pihak Ketiga</option>
                            </select>
                            @error('jenis_tubel')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="bulan">Bulan</label>
                                    <select name="bulan" id="bulan" class="form-control">
                                        <option value="">Pilih Bulan</option>
                                        @foreach ($data_bulan as $index => $bulan)
                                            <option value="{{ $index + 1 }}">{{ $bulan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                @php
                                    $startYear = 2020;
                                    $endYear = date('Y');
                                    $years = range($endYear, $startYear);
                                @endphp
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <select name="tahun" id="tahun" class="form-control">
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-print"></i>
                            Cetak
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
