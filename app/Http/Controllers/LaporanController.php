<?php

namespace App\Http\Controllers;

use App\Models\Tubel;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporanTubel()
    {
        return view('laporan.tubel', [
            'page_title' => 'Laporan Tubel'
        ]);
    }

    public function cetakTubel(Request $request)
    {
        $validated = $request->validate([
            'jenis_tubel' => 'required'
        ]);

        $page_title = 'Mandiri Tidak Berhenti Tugas';

        if ($validated['jenis_tubel'] == 'mbt') {
            $page_title = 'Mandiri Berhenti Tugas';
        } elseif ($validated['jenis_tubel'] == 'pk') {
            $page_title = 'Pihak Ketiga';
        }

        $user = auth()->user();
        $data_tubel = Tubel::where('jenis_tubel', $validated['jenis_tubel'])->get();

        if ($user->level == 'pegawai') {
            $data_tubel = Tubel::where('jenis_tubel', $validated['jenis_tubel'])->where('id_pegawai', $user->pegawai->id_pegawai)->get();
        }

        return view('tubel.print', [
            'page_title' => $page_title,
            'data_tubel' => $data_tubel
        ]);
    }
}
