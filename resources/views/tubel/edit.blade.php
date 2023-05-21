@extends('layouts.app')
@section('content')
    <form action="{{ route('tubel.update', $tubel->id_tubel) }}" method="POST">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $page_title }}</h3>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PATCH')
                        @if (Auth::user()->level == 'pegawai')
                            <input type="hidden" name="id_pegawai" value="{{ Auth::user()->pegawai->id_pegawai }}">
                        @else
                            <div class="form-group">
                                <label for="id_pegawai">Pegawai</label>
                                <select name="id_pegawai" id="id_pegawai"
                                    class="form-control @error('id_pegawai') is-invalid @enderror">
                                    <option value="">Pilih Pegawai</option>
                                    @foreach ($data_pegawai as $pegawai)
                                        <option value="{{ $pegawai->id_pegawai }}"
                                            {{ old('id_pegawai', $pegawai->id_pegawai) == $pegawai->id_pegawai ? 'selected' : '' }}>
                                            {{ $pegawai->nama }}</option>
                                    @endforeach
                                </select>
                                @error('id_pegawai')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="jenis_tubel">Jenis Tubel</label>
                            <select name="jenis_tubel" id="jenis_tubel"
                                class="form-control @error('jenis_tubel') is-invalid @enderror">
                                <option value="">Pilih Jenis</option>
                                <option value="mtbt" {{ $tubel->jenis_tubel == 'mtbt' ? 'selected' : '' }}>Mandiri Tidak
                                    Berhenti Tugas</option>
                                <option value="mbt" {{ $tubel->jenis_tubel == 'mbt' ? 'selected' : '' }}>Mandiri
                                    Berhenti Tugas</option>
                                <option value="pk" {{ $tubel->jenis_tubel == 'pk' ? 'selected' : '' }}>Pihak Ketiga
                                </option>
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
                                <option value="s1" {{ $tubel->jenjang == 's1' ? 'selected' : '' }}>S1</option>
                                <option value="s2" {{ $tubel->jenjang == 's2' ? 'selected' : '' }}>S2</option>
                                <option value="s3" {{ $tubel->jenjang == 's3' ? 'selected' : '' }}>S3</option>
                                <option value="d3" {{ $tubel->jenjang == 'd3' ? 'selected' : '' }}>D3</option>
                                <option value="d4" {{ $tubel->jenjang == 'd4' ? 'selected' : '' }}>D4</option>
                                <option value="profesi" {{ $tubel->jenjang == 'profesi' ? 'selected' : '' }}>Profesi
                                </option>
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
                                <option value="aktif" {{ $tubel->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="selesai" {{ $tubel->status == 'selesai' ? 'selected' : '' }}>Selesai
                                </option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="universitas">Universitas</label>
                            <input type="text" class="form-control @error('universitas') is-invalid @enderror"
                                name="universitas" value="{{ old('universitas', $tubel->universitas) }}"
                                placeholder="Masukkan Universitas">
                            @error('universitas')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_sk">Nomor SK</label>
                            <input type="text" class="form-control @error('no_sk') is-invalid @enderror" name="no_sk"
                                value="{{ old('no_sk', $tubel->no_sk) }}" placeholder="Masukkan Nomor SK">
                            @error('no_sk')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tgl_mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror"
                                name="tgl_mulai" value="{{ old('tgl_mulai', $tubel->tgl_mulai) }}">
                            @error('tgl_mulai')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tgl_selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror"
                                name="tgl_selesai" value="{{ old('tgl_selesai', $tubel->tgl_selesai) }}">
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
