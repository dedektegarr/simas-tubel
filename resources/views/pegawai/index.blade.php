@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col">
            <div class="row mb-2">
                <div class="col">
                    <!-- ADD modal -->
                    <a href="{{ route('pegawai.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Tambah Data
                    </a>
                    <a href="{{ route('pegawai.print') }}" target="_blank" class="btn btn-warning">
                        <i class="fas fa-print"></i>
                        Cetak
                    </a>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ $page_title }}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>No. Hp</th>
                                <th>Email</th>
                                <th>Golongan</th>
                                <th>Pangkat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_pegawai as $pegawai)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pegawai->nama }}</td>
                                    <td>{{ $pegawai->nip ?? '-' }}</td>
                                    <td>{{ $pegawai->no_hp }}</td>
                                    <td>{{ $pegawai->user->email ?? '-' }}</td>
                                    <td>{{ $pegawai->golongan }}</td>
                                    <td>{{ $pegawai->pangkat }}</td>
                                    <td>
                                        {{-- <a href="{{ route('pegawai.show', $pegawai->id_pegawai) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a> --}}
                                        <!-- ADD modal -->
                                        @if (Auth::user()->level == 'admin' || Auth::user()->level == 'pimpinan')
                                            <a href="{{ route('tubel.createByPegawai', $pegawai->id_pegawai) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fas fa-plus"></i>
                                                Tambah tubel
                                            </a>
                                        @endif
                                        <a href="{{ route('pegawai.edit', $pegawai->id_pegawai) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('pegawai.destroy', $pegawai->id_pegawai) }}" method="POST"
                                            class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                                        aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('pegawai.update', $pegawai->id_pegawai) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Data pegawai
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="nama">Nama</label>
                                                            <input type="text" name="nama"
                                                                class="form-control @error('nama') is-invalid @enderror"
                                                                placeholder="Masukkan Nama"
                                                                value="{{ old('nama', $pegawai->nama) }}">
                                                            @error('nama')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nip">NIP</label>
                                                            <input type="number" name="nip"
                                                                class="form-control @error('nip') is-invalid @enderror"
                                                                placeholder="Masukkan nip"
                                                                value="{{ old('nip', $pegawai->nip) }}">
                                                            @error('nip')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="no_hp">No. Hp</label>
                                                            <input type="number" name="no_hp"
                                                                class="form-control @error('no_hp') is-invalid @enderror"
                                                                placeholder="Masukkan no_hp"
                                                                value="{{ old('no_hp', $pegawai->no_hp) }}">
                                                            @error('no_hp')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="email" name="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                placeholder="Masukkan email"
                                                                value="{{ old('email', $pegawai->user->email) }}">
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
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        @if ($errors->any())
            $('#addModal').modal('show');
        @endif
    </script>
@endpush
