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

<div class="container mt-4">

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    

        {{-- auto hilang notif --}}
        <script>
            setTimeout(function() {
                let alert = document.querySelector('.alert');
                if(alert){
                    alert.remove();
                }
            }, 2000);
        </script>
    @endif

    <div class="card shadow-lg border-0">

       <form method="GET" action="{{ url('/') }}" class="mb-3">
            <div style="display: flex; gap: 10px;">
                <input type="text" name="search" placeholder="Cari nama mahasiswa..."
                value="{{ request('search') }}" class="form-control">

                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
        
         <a href="{{ route('admin.index') }}" 
            class="btn btn-success ">
            masuk ke Admin
        </a>
        <div class="card-body">
            {{-- tabel --}}
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Kelamin</th>
                        <th>Alamat</th>
                        <th>TL</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($mahasiswas as $mahasiswa)
                        <tr>
                            <td>
                                {{ $mahasiswa->NIM}}
                            </td>
                            <td>@if(request('search'))
                                 {!! str_ireplace(
                                    request('search'),
                                    '<span style="background-color: yellow;">'.request('search').'</span>',
                                    $mahasiswa->Nama
                                        ) !!}
                                    @else
                                        {{ $mahasiswa->Nama }}
                                    @endif</td>
                            <td>{{ $mahasiswa->Email }}</td>
                            <td>{{ $mahasiswa->Kelamin }}</td>
                            <td>{{ $mahasiswa->Alamat }}</td>
                            <td>{{ $mahasiswa->Tanggal_Lahir }}</td>

                        
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Data belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
           {{-- <td>
             <a href="{{ route('admin.index', $admin->id) }}" 
                class="btn btn-warning btn-sm me-1">Admin</a>
           </td> --}}
        </form>
        </div>
    </div>

</div>

@endsection

</body>
</html>