<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mahasiswa</title>
   
</head>
<body>
@extends('layout.app')

@section('content')

<div class="container mt-5">

    {{-- NOTIFIKASI SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" 
             role="alert" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Dashboard Admin - Data Mahasiswa</h4>
        </div>

        <div class="card-body">

            {{-- FORM TAMBAH MAHASISWA --}}
            <form method="POST" action="{{ route('admin.store') }}">
                @csrf

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <input type="text" name="NIM" class="form-control" placeholder="NIM" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <input type="text" name="Nama" class="form-control" placeholder="Nama" required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <input type="email" name="Email" class="form-control" placeholder="Email" required>
                    </div>

                    <div class="col-md-2 mb-3">
                        <select name="Kelamin" class="form-select" required>
                            <option value="">Pilih Kelamin</option>
                            <option value="Laki - Laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" name="Alamat" class="form-control" placeholder="Alamat">
                    </div>

                    <div class="col-md-2 mb-3">
                        <input type="date" name="Tanggal_Lahir" class="form-control">
                    </div>

                    <div class="col-md-1 mb-3">
                        <button type="submit" class="btn btn-primary w-100">
                            Tambah
                        </button>
                    </div>

                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                    
                </div>
            </form>

            <hr>

            <div class="mb-3 d-flex gap-3">
                <div class="p-3 bg-primary text-white rounded">
                    Laki - Laki: {{ $jumlahLaki }}
                </div>
                <div class="p-3 bg-danger text-white rounded">
                    Perempuan: {{ $jumlahPerempuan }}
                </div>
                <div class="p-3 bg-success text-white rounded">
                    Total Mahasiswa: {{ $totalMahasiswa }}
                </div>
            </div>

            {{-- TABEL DATA --}}
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Kelamin</th>
                            <th>Alamat</th>
                            <th>TL</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswas as $m)
                        <tr>
                            <td>{{ $m->NIM }}</td>
                            <td>{{ $m->Nama }}</td>
                            <td>{{ $m->Email }}</td>
                            <td>{{ $m->Kelamin }}</td>
                            <td>{{ $m->Alamat }}</td>
                            <td>{{ $m->Tanggal_Lahir }}</td>

                            {{-- tombol hapus dan edit --}}
                             <td>
                                <a href="{{ route('admin.edit', $m->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <form action="{{ route('admin.destroy', $m->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if($mahasiswas->isEmpty())
                        <tr>
                            <td colspan="5" class="text-muted">
                                Belum ada data mahasiswa
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


<script>
    setTimeout(function () {
        let alert = document.getElementById('success-alert');
        if (alert) {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 500);
        }
    }, 2000);
</script>

@endsection
</body>
</html>