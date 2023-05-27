@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col">
            @if (!$data_aktif)
                <div class="row mb-2">
                    <div class="col">
                        <!-- ADD modal -->
                        <a href="{{ route('tubel.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Tambah Data
                        </a>
                    </div>
                </div>
            @endif
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Tubel Aktif</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="table">
                        <thead>
                            <tr>
                                <th>Nomor SK</th>
                                <th>Pegawai</th>
                                <th>NIP</th>
                                <th>Jenis Tubel</th>
                                <th>Jenjang</th>
                                <th>Universitas</th>
                                <th>Tanggal Mulai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data_tubel as $tubel)
                                @if ($tubel->status == 'aktif')
                                    @php
                                        $jenis_tubel = null;
                                        
                                        if ($tubel->jenis_tubel === 'mtbt') {
                                            $jenis_tubel = 'Mandiri Tidak Berhenti Tugas';
                                        } elseif ($tubel->jenis_tubel === 'mbt') {
                                            $jenis_tubel = 'Mandiri Berhenti Tugas';
                                        } else {
                                            $jenis_tubel = 'Pihak Ketiga';
                                        }
                                        
                                        $status = null;
                                        
                                        if ($tubel->status == 'aktif') {
                                            $status = '<span class="badge badge-success">Aktif</span>';
                                        } else {
                                            $status = '<span class="badge badge-secondary">Selesai</span>';
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $tubel->no_sk }}</td>
                                        <td>{{ $tubel->pegawai->nama }}</td>
                                        <td>{{ $tubel->pegawai->nip ?? '-' }}</td>
                                        <td>{{ $jenis_tubel }}</td>
                                        <td>{{ strtoupper($tubel->jenjang) }}</td>
                                        <td>{{ $tubel->universitas }}</td>
                                        <td>{{ $tubel->tgl_mulai }}</td>
                                        <td>{!! $status !!}</td>
                                        <td>
                                            <a href="{{ route('tubel.edit', $tubel->id_tubel) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if (Auth::user()->level == 'admin')
                                                <form action="{{ route('tubel.destroy', $tubel->id_tubel) }}" method="POST"
                                                    class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td class="text-center" colspan="8">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Tubel Selesai</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="table">
                        <thead>
                            <tr>
                                <th>Nomor SK</th>
                                <th>Pegawai</th>
                                <th>Jenis Tubel</th>
                                <th>Jenjang</th>
                                <th>Universitas</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data_tubel as $tubel)
                                @if ($tubel->status == 'selesai')
                                    @php
                                        $jenis_tubel = null;
                                        
                                        if ($tubel->jenis_tubel === 'mtbt') {
                                            $jenis_tubel = 'Mandiri Tidak Berhenti Tugas';
                                        } elseif ($tubel->jenis_tubel === 'mbt') {
                                            $jenis_tubel = 'Mandiri Berhenti Tugas';
                                        } else {
                                            $jenis_tubel = 'Pihak Ketiga';
                                        }
                                        
                                        $status = null;
                                        
                                        if ($tubel->status == 'aktif') {
                                            $status = '<span class="badge badge-success">Aktif</span>';
                                        } else {
                                            $status = '<span class="badge badge-secondary">Selesai</span>';
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $tubel->no_sk }}</td>
                                        <td>{{ $tubel->pegawai->nama }}</td>
                                        <td>{{ $jenis_tubel }}</td>
                                        <td>{{ strtoupper($tubel->jenjang) }}</td>
                                        <td>{{ $tubel->universitas }}</td>
                                        <td>{{ $tubel->tgl_selesai }}</td>
                                        <td>{!! $status !!}</td>
                                        @if (Auth::user()->level == 'admin')
                                            <td>
                                                <a href="{{ route('tubel.edit', $tubel->id_tubel) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                        @endif
                                        @if (Auth::user()->level == 'admin')
                                            <form action="{{ route('tubel.destroy', $tubel->id_tubel) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td class="text-center" colspan="8">Tidak ada data</td>
                                </tr>
                            @endforelse
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
