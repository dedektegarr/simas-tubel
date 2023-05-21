<?php

namespace App\Http\Controllers;

use App\Models\Pimpinan;
use App\Models\User;
use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pimpinan.index', [
            'page_title' => 'Data Pimpinan',
            'data_pimpinan' => Pimpinan::orderByDesc('created_at')->get()
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
            'nama' => 'required',
            'nip' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $akun = [
            'email' => $validated['email'],
            'password' => bcrypt($request->password),
            'level' => 'pimpinan'
        ];

        $akun_created = User::create($akun);

        $pimpinan = [
            'nama' => $validated['nama'],
            'nip' => $validated['nip'],
            'no_hp' => $validated['no_hp'],
            'id_user' => $akun_created->id
        ];

        Pimpinan::create($pimpinan);

        return redirect()->back()->with('success', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pimpinan $pimpinan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pimpinan $pimpinan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pimpinan $pimpinan)
    {
        $rules = [
            'nama' => 'required',
            'nip' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'password' => 'nullable',
            'email' => 'nullable'
        ];

        if ($pimpinan->user->email !== $request->email) {
            $rules['email'] = 'required|email|unique:users';
        }

        $validated = $request->validate($rules);

        $akun = [
            'email' => $validated['email'],
            'level' => 'pimpinan'
        ];

        if ($request->password != null) {
            $akun['password'] = bcrypt($request->password);
        }

        User::find($pimpinan->user->id)->update($akun);

        $updatedPimpinan = [
            'nama' => $validated['nama'],
            'nip' => $validated['nip'],
            'no_hp' => $validated['no_hp']
        ];

        Pimpinan::where('id_pimpinan', $pimpinan->id_pimpinan)->update($updatedPimpinan);

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pimpinan $pimpinan)
    {
        Pimpinan::where('id_pimpinan', $pimpinan->id_pimpinan)->delete();
        User::find($pimpinan->user->id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function print()
    {
        return view('pimpinan.print', [
            'page_title' => 'Cetak Data Pimpinan',
            'data_pimpinan' => Pimpinan::orderByDesc('created_at')->get()
        ]);
    }
}
