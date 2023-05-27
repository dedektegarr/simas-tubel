@extends('layouts.app')
@section('content')
    <form action="{{ route('tubel.store') }}" method="POST">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $page_title }}</h3>
                    </div>
                    <div class="card-body">
                        @csrf
                        @if (Auth::user()->level == 'pegawai')
                            <input type="hidden" name="id_pegawai" value="{{ Auth::user()->pegawai->id_pegawai }}">
                        @else
                            @if (isset($pegawai))
                                <input type="hidden" name="id_pegawai" value="{{ $pegawai->id_pegawai }}">
                                <div class="form-group">
                                    <label for="nama">Pegawai</label>
                                    <input type="text" class="form-control" name="nama" value="{{ $pegawai->nama }}"
                                        readonly>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="id_pegawai">Pegawai</label>
                                    <select name="id_pegawai" id="id_pegawai"
                                        class="form-control @error('id_pegawai') is-invalid @enderror">
                                        <option value="">Pilih Pegawai</option>
                                        @foreach ($data_pegawai as $pegawai)
                                            <option value="{{ $pegawai->id_pegawai }}"
                                                {{ old('id_pegawai') == $pegawai->id_pegawai ? 'selected' : '' }}>
                                                {{ $pegawai->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_pegawai')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                        @endif

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
                        <div class="form-group">
                            <label for="jenjang">Jenjang</label>
                            <select name="jenjang" id="jenjang"
                                class="form-control @error('jenjang') is-invalid @enderror">
                                <option value="">Pilih Jenjang</option>
                                <option value="s1">S1</option>
                                <option value="s2">S2</option>
                                <option value="s3">S3</option>
                                <option value="d3">D3</option>
                                <option value="d4">D4</option>
                                <option value="profesi">Profesi</option>
                            </select>
                            @error('jenjang')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="">Pilih Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="selesai">Selesai</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="universitas">Universitas</label>
                            <input type="text" class="form-control @error('universitas') is-invalid @enderror"
                                name="universitas" value="{{ old('universitas') }}" placeholder="Masukkan Universitas">
                            @error('universitas')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_sk">Nomor SK</label>
                            <input type="text" class="form-control @error('no_sk') is-invalid @enderror" name="no_sk"
                                value="{{ old('no_sk') }}" placeholder="Masukkan Nomor SK">
                            @error('no_sk')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tgl_mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror"
                                name="tgl_mulai" value="{{ old('tgl_mulai') }}">
                            @error('tgl_mulai')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tgl_selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror"
                                name="tgl_selesai" value="{{ old('tgl_selesai') }}">
                            @error('tgl_selesai')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
