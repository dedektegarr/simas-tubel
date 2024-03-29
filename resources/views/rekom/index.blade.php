@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col">
            <div class="row mb-2">
                <div class="col">
                    <!-- ADD modal -->
                    @if (Auth::user()->level == 'admin')
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus"></i>
                            Tambah Data
                        </button>
                    @endif
                    <a href="{{ route('rekomendasi.print') }}" target="_blank" class="btn btn-warning">
                        <i class="fas fa-print"></i>
                        Cetak
                    </a>
                </div>
            </div>

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ $page_title }}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="table">
                        <thead>
                            <tr>
                                <th>No. Rekom</th>
                                <th>Nama Pegawai</th>
                                <th>NIP</th>
                                <th>Universitas</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data_rekom as $rekom)
                                <tr>
                                    <td>{{ $rekom->no_rekom }}</td>
                                    <td>{{ $rekom->pegawai->nama }}</td>
                                    <td>{{ $rekom->pegawai->nip ?? '-' }}</td>
                                    <td>{{ $rekom->universitas }}</td>
                                    <td>{{ $rekom->tgl_rekom }}</td>
                                    <td>{!! $rekom->status
                                        ? '<span class="badge badge-success">Disetujui</span>'
                                        : '<span class="badge badge-secondary">Menunggu persetujuan</span>' !!}
                                    </td>
                                    <td>
                                        @if (Auth::user()->level == 'admin')
                                            <!-- Edit modal -->
                                            <button type="button" class="btn btn-warning btn-sm btn" data-toggle="modal"
                                                data-target="#editModal-{{ $rekom->id_rekom }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('rekomendasi.destroy', $rekom->id_rekom) }}"
                                                method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            @if ($rekom->status)
                                                <a href="{{ route('rekomendasi.cetakSurat', $rekom->id_rekom) }}"
                                                    target="_blank" class="btn btn-sm btn-info" target="_blank">
                                                    <i class="fas fa-print"></i>
                                                    Cetak Surat
                                                </a>
                                            @endif
                                        @endif
                                        @if (Auth::user()->level == 'pegawai')
                                            @if ($rekom->status)
                                                <a href="{{ route('rekomendasi.cetakSurat', $rekom->id_rekom) }}"
                                                    target="_blank" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-print"></i>
                                                    Cetak Surat
                                                </a>
                                            @endif
                                        @endif
                                        @if (Auth::user()->level == 'pimpinan')
                                            @if ($rekom->status)
                                                <a href="{{ route('rekomendasi.cetakSurat', $rekom->id_rekom) }}"
                                                    target="_blank" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-print"></i>
                                                    Cetak Surat
                                                </a>
                                            @else
                                                <form action="{{ route('rekomendasi.updateStatus', $rekom->id_rekom) }}"
                                                    method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-success"
                                                        onclick="return confirm('Yakin ingin menyetujui rekomendasi ini?')">
                                                        <i class="fas fa-check"></i>
                                                        Setujui
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    </td>
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal-{{ $rekom->id_rekom }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('rekomendasi.update', $rekom->id_rekom) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Data rekom
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="no_rekom">Nomor Rekom</label>
                                                            <input type="text"
                                                                class="form-control @error('no_rekom') is-invalid @enderror"
                                                                name="no_rekom"
                                                                value="{{ old('no_rekom', $rekom->no_rekom) }}"
                                                                placeholder="Masukkan Nomor Rekom">
                                                            @error('no_rekom')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        @if (Auth::user()->level == 'admin')
                                                            <div class="form-group">
                                                                <label for="id_pimpinan">Pimpinan</label>
                                                                <input type="hidden" name="id_pimpinan"
                                                                    value="{{ $pimpinan->id_pimpinan ?? '' }}">
                                                                <input type="text" class="form-control" readonly
                                                                    value="{{ $pimpinan->nama ?? '' }}">
                                                                @error('id_pimpinan')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        @endif
                                                        @if (Auth::user()->level == 'pimpinan')
                                                            <input type="hidden" name="id_pimpinan"
                                                                value="{{ Auth::user()->pimpinan->id_pimpinan }}">
                                                        @endif
                                                        <div class="form-group">
                                                            <label for="id_pegawai">Pegawai</label>
                                                            <select name="id_pegawai" id="id_pegawai"
                                                                class="form-control @error('id_pegawai') is-invalid @enderror">
                                                                <option value="">Pilih Pegawai</option>
                                                                @foreach ($data_pegawai as $pegawai)
                                                                    <option value="{{ $pegawai->id_pegawai }}"
                                                                        {{ old('id_pegawai', $rekom->id_pegawai) == $pegawai->id_pegawai ? 'selected' : '' }}>
                                                                        {{ $pegawai->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('id_pegawai')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="universitas">Universitas</label>
                                                            <input type="text"
                                                                class="form-control @error('universitas') is-invalid @enderror"
                                                                name="universitas"
                                                                value="{{ old('universitas', $rekom->universitas) }}"
                                                                placeholder="Masukkan Universitas">
                                                            @error('universitas')
                                                                <span class="invalid-feedback">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="tgl_rekom">Tanggal Rekom</label>
                                                            <input type="date"
                                                                class="form-control @error('tgl_rekom') is-invalid @enderror"
                                                                name="tgl_rekom"
                                                                value="{{ old('tgl_rekom', $rekom->tgl_rekom) }}"
                                                                placeholder="Masukkan Nomor SK">
                                                            @error('tgl_rekom')
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
                            @empty
                                <tr>
                                    <td class="text-center" colspan="8">Anda tidak memiliki rekomendasi</td>
                                </tr>
                            @endforelse
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
                <form action="{{ route('rekomendasi.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Tambah Data rekom</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="no_rekom">Nomor Rekom</label>
                            <input type="text" class="form-control @error('no_rekom') is-invalid @enderror"
                                name="no_rekom" value="{{ old('no_rekom') }}" placeholder="Masukkan Nomor Rekom">
                            @error('no_rekom')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        @if (Auth::user()->level == 'admin')
                            <div class="form-group">
                                <label for="id_pimpinan">Pimpinan</label>
                                <input type="hidden" name="id_pimpinan" value="{{ $pimpinan->id_pimpinan ?? '' }}">
                                <input type="text" class="form-control" readonly value="{{ $pimpinan->nama ?? '' }}">
                                @error('id_pimpinan')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                        @if (Auth::user()->level == 'pimpinan')
                            <input type="hidden" name="id_pimpinan" value="{{ Auth::user()->pimpinan->id_pimpinan }}">
                        @endif

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

                        <div class="form-group">
                            <label for="universitas">Universitas</label>
                            <input type="text" class="form-control @error('universitas') is-invalid @enderror"
                                name="universitas" value="{{ old('universitas') }}" placeholder="Masukkan Universitas">
                            @error('universitas')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tgl_rekom">Tanggal Rekom</label>
                            <input type="date" class="form-control @error('tgl_rekom') is-invalid @enderror"
                                name="tgl_rekom" value="{{ old('tgl_rekom') }}" placeholder="Masukkan Nomor SK">
                            @error('tgl_rekom')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
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
