<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $mahasiswas = Mahasiswa::orderBy('NIM', 'asc')->get();

    // Hitung jumlah per kelamin
    $jumlahLaki = Mahasiswa::where('Kelamin', 'Laki - Laki')->count();
    $jumlahPerempuan = Mahasiswa::where('Kelamin', 'Perempuan')->count();
    $totalMahasiswa = $jumlahLaki + $jumlahPerempuan;


    return view('admin.index', compact('mahasiswas', 'jumlahLaki', 'jumlahPerempuan', 'totalMahasiswa'));

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NIM' => 'required',
            'Nama' => 'required',
            'Email'=>'required|Email',
            'Kelamin'=>'required',
            'Alamat'=> 'nullable',
            'Tanggal_Lahir'=>'nullable|date',
        ]);
        Mahasiswa::create([
        'NIM' => $request->NIM,
        'Nama' => $request->Nama,
        'Email' => $request->Email,
        'Kelamin' => $request->Kelamin,
        'Alamat' => $request->Alamat,
        'Tanggal_Lahir' => $request->Tanggal_Lahir,


    ]);

       
        return redirect()
        ->route('admin.index')
        ->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('admin.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin, $id)
    {
        $request->validate([
        'NIM' => 'required|unique:mahasiswas,NIM,' . $id,
        'Nama' => 'required',
        'Email' => 'required|email',
        'Kelamin' => 'required',
    ]);

    $mahasiswa = Mahasiswa::findOrFail($id);

    $mahasiswa->update([
        'NIM' => $request->NIM,
        'Nama' => $request->Nama,
        'Email' => $request->Email,
        'Kelamin' => $request->Kelamin,
    ]);

    return redirect()->route('admin.index')
                     ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin, $id)
    {
         $mahasiswa = Mahasiswa::findOrfail($id); $mahasiswa->delete(); return redirect() ->route('admin.index');
    }
 }

