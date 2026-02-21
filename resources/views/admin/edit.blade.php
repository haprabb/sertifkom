

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    
</head>
<body>
@extends('layout.app')

@section('content')

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">Edit Data Mahasiswa</h4>
        </div>

        <div class="card-body">

            {{-- VALIDATION ERROR --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.update', $mahasiswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="text" name="NIM" 
                        class="form-control bg-light" 
                        value="{{ $mahasiswa->NIM }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="Nama" 
                        class="form-control" 
                        value="{{ $mahasiswa->Nama }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="Email" 
                        class="form-control" 
                        value="{{ $mahasiswa->Email }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="Kelamin" class="form-select" required>
                        <option value="Laki - Laki" 
                            {{ $mahasiswa->Kelamin == 'Laki - Laki' ? 'selected' : '' }}>
                            Laki - Laki
                        </option>
                        <option value="Perempuan" 
                            {{ $mahasiswa->Kelamin == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" name="Alamat" class="form-control" 
                        value="{{ $mahasiswa->Alamat }}" placeholder="Alamat">
                </div>

                <div class="col-md-2 mb-3">
                    <input type="date" name="Tanggal_Lahir" class="form-control" 
                        value="{{ $mahasiswa->Tanggal_Lahir }}">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-success">
                        Update Data
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection


</body>
</html>