<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pegawai.index', [
            'page_title' => 'Data Pegawai',
            'data_pegawai' => Pegawai::orderByDesc('created_at')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pegawai.tambah', [
            'page_title' => 'Tambah Data Pegawai'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'nip' => 'nullable|numeric',
            'no_hp' => 'required|numeric',
            'golongan' => 'required',
            'pangkat' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $akun = [
            'email' => $validated['email'],
            'password' => bcrypt($request->password),
            'level' => 'pegawai'
        ];

        $akun_created = User::create($akun);

        $pegawai = [
            'nama' => $validated['nama'],
            'nip' => $validated['nip'],
            'no_hp' => $validated['no_hp'],
            'golongan' => $validated['golongan'],
            'pangkat' => $validated['pangkat'],
            'alamat' => $validated['alamat'],
            'id_user' => $akun_created->id
        ];

        Pegawai::create($pegawai);

        return redirect()->route('pegawai.index')->with('success', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', [
            'page_title' => 'Edit Data Pegawai',
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $rules = [
            'nama' => 'required',
            'nip' => 'nullable|numeric',
            'no_hp' => 'required|numeric',
            'golongan' => 'required',
            'pangkat' => 'required',
            'alamat' => 'required',
            'password' => 'nullable',
            'email' => 'nullable'
        ];

        if ($pegawai->user->email !== $request->email) {
            $rules['email'] = 'required|email|unique:users';
        }


        $validated = $request->validate($rules);

        $akun = [
            'email' => $validated['email'],
            'level' => 'pegawai'
        ];

        if ($request->password != null) {
            $akun['password'] = bcrypt($request->password);
        }

        User::find($pegawai->user->id)->update($akun);

        $updatedPegawai = [
            'nama' => $validated['nama'],
            'nip' => $validated['nip'],
            'no_hp' => $validated['no_hp'],
            'golongan' => $validated['golongan'],
            'pangkat' => $validated['pangkat'],
            'alamat' => $validated['alamat'],
        ];

        Pegawai::where('id_pegawai', $pegawai->id_pegawai)->update($updatedPegawai);

        return redirect()->route('pegawai.index')->with('success', 'Data berhasil ditambah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $pegawai)
    {
        Pegawai::where('id_pegawai', $pegawai->id_pegawai)->delete();
        User::find($pegawai->user->id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function print()
    {
        return view('pegawai.print', [
            'page_title' => 'Cetak Data pegawai',
            'data_pegawai' => Pegawai::orderByDesc('created_at')->get()
        ]);
    }
}
