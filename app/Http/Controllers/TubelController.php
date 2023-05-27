<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Tubel;
use Illuminate\Http\Request;

class TubelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $data_tubel = Tubel::all();
        $page_title = 'Data Tubel';
        $data_aktif = null;

        if ($user->level == 'pegawai') {
            $data_tubel = Tubel::where('id_pegawai', $user->pegawai->id_pegawai)->get();
            $data_aktif = Tubel::where('id_pegawai', $user->pegawai->id_pegawai)->where('status', 'aktif')->count();
            $page_title = 'Tubel Saya';
        }

        return view('tubel.index', [
            'page_title' => $page_title,
            'data_tubel' => $data_tubel,
            'data_aktif' => $data_aktif
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tubel.tambah', [
            'page_title' => 'Tambah Data Tubel',
            'data_pegawai' => Pegawai::all()
        ]);
    }

    public function createByPegawai(Pegawai $pegawai)
    {
        return view('tubel.tambah', [
            'page_title' => 'Tambah Data Tubel',
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pegawai' => 'required',
            'jenis_tubel' => 'required',
            'jenjang' => 'required',
            'status' => 'required',
            'universitas' => 'required',
            'no_sk' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'nullable'
        ]);

        $data_aktif = Tubel::where('id_pegawai', $validated['id_pegawai'])->where('status', 'aktif')->count();

        if ($data_aktif) {
            return redirect()->back()->with('error', 'Pegawai memiliki tubel yang aktif');
        }

        Tubel::create($validated);

        return redirect()->route('tubel.index')->with('success', 'Data berasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tubel $tubel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tubel $tubel)
    {
        return view('tubel.edit', [
            'page_title' => 'Edit Data Tubel',
            'tubel' => $tubel,
            'data_pegawai' => Pegawai::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tubel $tubel)
    {
        $validated = $request->validate([
            'id_pegawai' => 'required',
            'jenis_tubel' => 'required',
            'jenjang' => 'required',
            'status' => 'required',
            'universitas' => 'required',
            'no_sk' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'nullable'
        ]);

        Tubel::where('id_tubel', $tubel->id_tubel)->update($validated);

        return redirect()->route('tubel.index')->with('success', 'Data berasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tubel $tubel)
    {
        Tubel::where('id_tubel', $tubel->id_tubel)->delete();

        return redirect()->route('tubel.index')->with('success', 'Data berasil dihapus');
    }
}