<?php

namespace App\Http\Controllers;

use App\Models\Tubel;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporanTubel()
    {
        $data_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return view('laporan.tubel', [
            'page_title' => 'Laporan Tubel',
            'data_bulan' => $data_bulan
        ]);
    }

    public function cetakTubel(Request $request)
    {
        $validated = $request->validate([
            'jenis_tubel' => 'required',
            'bulan' => 'nullable',
            'tahun' => 'required'
        ]);

        $page_title = 'Mandiri Tidak Berhenti Tugas';

        if ($validated['jenis_tubel'] == 'mbt') {
            $page_title = 'Mandiri Berhenti Tugas';
        } elseif ($validated['jenis_tubel'] == 'pk') {
            $page_title = 'Pihak Ketiga';
        }

        $user = auth()->user();
        $data_tubel = Tubel::filter()->get();

        if ($user->level == 'pegawai') {
            $data_tubel = Tubel::filter()->where('id_pegawai', $user->pegawai->id_pegawai)->get();
        }

        return view('tubel.print', [
            'page_title' => $page_title,
            'data_tubel' => $data_tubel
        ]);
    }
}