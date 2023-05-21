@extends('layouts.app')
@section('content')
    <form action="{{ route('pegawai.update', $pegawai->id_pegawai) }}" method="POST">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $page_title }}</h3>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                value="{{ old('nama', $pegawai->nama) }}" placeholder="Masukkan Nama">
                            @error('nama')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="number" class="form-control @error('nip') is-invalid @enderror" name="nip"
                                value="{{ old('nip', $pegawai->nip) }}" placeholder="Masukkan NIP">
                            @error('nip')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No. Hp</label>
                            <input type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                                value="{{ old('no_hp', $pegawai->no_hp) }}" placeholder="Masukkan No. Hp">
                            @error('no_hp')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="golongan">Golongan</label>
                            <select name="golongan" id="golongan"
                                class="form-control @error('golongan') is-invalid @enderror">
                                <option value="">Pilih Golongan</option>
                                <option value="1" {{ old('golongan', $pegawai->golongan) == 1 ? 'selected' : '' }}>1
                                </option>
                                <option value="2" {{ old('golongan', $pegawai->golongan) == 2 ? 'selected' : '' }}>2
                                </option>
                                <option value="3" {{ old('golongan', $pegawai->golongan) == 3 ? 'selected' : '' }}>3
                                </option>
                            </select>
                            @error('golongan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pangkat">Pangkat</label>
                            <input type="text" class="form-control @error('pangkat') is-invalid @enderror" name="pangkat"
                                value="{{ old('pangkat', $pegawai->pangkat) }}" placeholder="Masukkan pangkat">
                            @error('pangkat')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">alamat</label>
                            <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $pegawai->alamat) }}</textarea>
                            @error('alamat')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="h3 card-title">Akun</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Masukkan email" value="{{ old('email', $pegawai->user->email) }}">
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Ubah Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Masukkan password">
                            @error('password')
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
