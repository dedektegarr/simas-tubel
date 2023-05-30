<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pimpinan;
use App\Models\Rekom;
use Illuminate\Http\Request;

class RekomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $data_rekom = Rekom::all();
        $page_title = 'Data Rekom';

        if ($user->level == 'pegawai') {
            $data_rekom = Rekom::where('id_pegawai', $user->pegawai->id_pegawai)->get();
            $page_title = 'Rekomendasi';
        }

        if ($user->level == 'pimpinan') {
            $data_rekom = Rekom::where('id_pimpinan', $user->pimpinan->id_pimpinan)->get();
            $page_title = 'Rekomendasi';
        }

        return view('rekom.index', [
            'page_title' => $page_title,
            'data_rekom' => $data_rekom,
            'data_pegawai' => Pegawai::all(),
            'pimpinan' => Pimpinan::where('status', 1)->first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pegawai' => 'required',
            'id_pimpinan' => 'required',
            'no_rekom' => 'required',
            'universitas' => 'required',
            'tgl_rekom' => 'required',
        ]);

        $validated['status'] = 0;
        Rekom::create($validated);

        return redirect()->route('rekomendasi.index')->with('success', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rekom $rekom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rekom $rekom)
    {
        //
    }

    public function updateStatus(Rekom $rekomendasi)
    {
        Rekom::where('id_rekom', $rekomendasi->id_rekom)->update([
            'status' => 1
        ]);

        return redirect()->back()->with('success', 'Rekomendasi dengan nomor ' . $rekomendasi->no_rekom . ' telah disetujui');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rekom $rekomendasi)
    {
        $validated = $request->validate([
            'id_pegawai' => 'required',
            'id_pimpinan' => 'required',
            'no_rekom' => 'required',
            'tgl_rekom' => 'required',
            'universitas' => 'required'
        ]);


        Rekom::where('id_rekom', $rekomendasi->id_rekom)->update($validated);

        return redirect()->route('rekomendasi.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rekom $rekomendasi)
    {
        Rekom::where('id_rekom', $rekomendasi->id_rekom)->delete();
        return redirect()->route('rekomendasi.index')->with('success', 'Data berhasil dihapus');
    }

    public function print()
    {
        $user = auth()->user();
        $data_rekom = Rekom::orderByDesc('created_at')->get();

        if ($user->level == 'pimpinan') {
            $data_rekom = Rekom::where('id_pimpinan', $user->pimpinan->id_pimpinan)->orderByDesc('created_at')->get();
        } elseif ($user->level == 'pegawai') {
            $data_rekom = Rekom::where('id_pegawai', $user->pegawai->id_pegawai)->orderByDesc('created_at')->get();
        }

        return view('rekom.print', [
            'page_title' => 'Cetak Data rekom',
            'data_rekom' => $data_rekom
        ]);
    }

    public function cetakSurat(Rekom $rekomendasi)
    {
        return view('rekom.surat', [
            'page_title' => 'Rekomendasi',
            'rekom' => $rekomendasi
        ]);
    }
}