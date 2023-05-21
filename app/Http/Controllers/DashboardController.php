<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pimpinan;
use App\Models\Rekom;
use App\Models\Tubel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $tubel_selesai = Tubel::where('status', 'selesai')->count();
        $tubel_aktif = Tubel::where('status', 'aktif')->count();

        $jumlah_rekom = Rekom::all()->count();
        $jumlah_tubel = Tubel::all()->count();

        if ($user->level == 'pegawai') {
            $jumlah_rekom = Rekom::where('id_pegawai', $user->pegawai->id_pegawai)->count();
            $jumlah_tubel = Tubel::where('id_pegawai', $user->pegawai->id_pegawai)->count();

            $tubel_selesai = Tubel::where('status', 'selesai')->where('id_pegawai', $user->pegawai->id_pegawai)->count();
            $tubel_aktif = Tubel::where('status', 'aktif')->where('id_pegawai', $user->pegawai->id_pegawai)->count();
        } elseif ($user->level == 'pimpinan') {
            $jumlah_rekom = Rekom::where('id_pimpinan', $user->pimpinan->id_pimpinan)->count();
        }

        return view('dashboard.index', [
            'page_title' => 'Dashboard',
            'jumlah_pimpinan' => Pimpinan::all()->count(),
            'jumlah_pegawai' => Pegawai::all()->count(),
            'jumlah_rekom' => $jumlah_rekom,
            'jumlah_tubel' => $jumlah_tubel,
            'tubel_chart' => [$tubel_aktif, $tubel_selesai]
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}