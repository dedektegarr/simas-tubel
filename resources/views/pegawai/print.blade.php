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

    <div class="container">
        <h3 class="text-center my-4">{{ $page_title }}</h3>
        <div class="row">
            <div class="col-md-12">
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th width="15px">No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>No. HP</th>
                            <th>Email</th>
                            <th>Golongan</th>
                            <th>Pangkat</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    @foreach ($data_pegawai as $pegawai)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $pegawai->nip ?? '-' }}</td>
                                <td>{{ $pegawai->nama }}</td>
                                <td>{{ $pegawai->no_hp }}</td>
                                <td>{{ $pegawai->user->email }}</td>
                                <td>{{ $pegawai->golongan }}</td>
                                <td>{{ $pegawai->pangkat }}</td>
                                <td>{{ $pegawai->alamat }}</td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>

</html>
