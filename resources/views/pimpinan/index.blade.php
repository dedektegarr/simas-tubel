@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col">
            <div class="row mb-2">
                <div class="col">
                    <!-- ADD modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                        <i class="fas fa-plus"></i>
                        Tambah Data
                    </button>
                    <a href="{{ route('pimpinan.print') }}" target="_blank" class="btn btn-warning">
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
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_pimpinan as $pimpinan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pimpinan->nama }}</td>
                                    <td>{{ $pimpinan->nip }}</td>
                                    <td>{{ $pimpinan->no_hp }}</td>
                                    <td>{{ $pimpinan->user->email }}</td>
                                    <td>{!! $pimpinan->status
                                        ? '<span class="badge badge-success">Aktif</span>'
                                        : '<span class="badge badge-secondary">Tidak Aktif</span>' !!}
                                    </td>
                                    <td>
                                        <!-- Edit modal -->
                                        <button type="button" class="btn btn-warning btn-sm btn" data-toggle="modal"
                                            data-target="#editModal-{{ $pimpinan->id_pimpinan }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('pimpinan.destroy', $pimpinan->id_pimpinan) }}"
                                            method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @if (!$pimpinan->status)
                                            <form action="{{ route('pimpinan.updateStatus', $pimpinan->id_pimpinan) }}"
                                                method="POST" class="d-inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-info"
                                                    onclick="return confirm('Yakin ingin menjadikan {{ $pimpinan->nama }} sebagai pimpinan baru?')">
                                                    <i class="fas fa-user"></i>
                                                    Aktifkan
                                                </button>
                                            </form>
                                        @endif
                                    </td>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal-{{ $pimpinan->id_pimpinan }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('pimpinan.update', $pimpinan->id_pimpinan) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Data Pimpinan
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
                                                                value="{{ old('nama', $pimpinan->nama) }}">
                                                            @error('nama')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nip">NIP</label>
                                                            <input type="number" name="nip"
                                                                class="form-control @error('nip') is-invalid @enderror"
                                                                placeholder="Masukkan nip"
                                                                value="{{ old('nip', $pimpinan->nip) }}">
                                                            @error('nip')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="no_hp">No. Hp</label>
                                                            <input type="number" name="no_hp"
                                                                class="form-control @error('no_hp') is-invalid @enderror"
                                                                placeholder="Masukkan no_hp"
                                                                value="{{ old('no_hp', $pimpinan->no_hp) }}">
                                                            @error('no_hp')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="email" name="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                placeholder="Masukkan email"
                                                                value="{{ old('email', $pimpinan->user->email) }}">
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

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('pimpinan.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Data Pimpinan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                placeholder="Masukkan Nama" value="{{ old('nama') }}">
                            @error('nama')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="number" name="nip" class="form-control @error('nip') is-invalid @enderror"
                                placeholder="Masukkan nip" value="{{ old('nip') }}">
                            @error('nip')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No. Hp</label>
                            <input type="number" name="no_hp"
                                class="form-control @error('no_hp') is-invalid @enderror" placeholder="Masukkan no_hp"
                                value="{{ old('no_hp') }}">
                            @error('no_hp')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email"
                                value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Masukkan password">
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status') ? 'active' : '' }}>Aktif</option>
                                <option value="0" {{ old('status') ? 'active' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="addForm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
    <script>
        @if ($errors->any())
            $('#addModal').modal('show');
        @endif
    </script>
@endpush
