<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Symfony\Component\Console\Color;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Mahasiswa::query();
        if ($request->search) {
        $query->where('Nama', 'like', '%' . $request->search . '%');
    }

        $mahasiswas = Mahasiswa::orderBy('NIM', 'asc')->get();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('admin.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa, $id)
    {
        $request->validate([
        'NIM' => 'required|unique:mahasiswas,NIM,' . $id,
        'Nama' => 'required',
        'Email' => 'required|email',
        'Kelamin' => 'required',
        ''
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
    public function destroy(Mahasiswa $mahasiswa)
    {
         $mahasiswa->delete();

    return redirect()->route('admin.index')
                     ->with('success', 'Data berhasil dihapus');
    }
}
