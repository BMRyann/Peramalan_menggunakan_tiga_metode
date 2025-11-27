<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;


class SiswaController extends Controller
{
    public function index()
    {
        $siswa = \App\Models\Siswa::all(); // model mengarah ke tabel data_siswa
        return view('siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|digits:4',
            'jumlah_siswa' => 'required|numeric',
        ]);

        Siswa::create([
            'tahun' => $request->tahun,
            'jumlah_siswa' => $request->jumlah_siswa,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $siswa = Siswa::where('id_siswa', $id)->firstOrFail();
        return view('siswa.edit', compact('siswa'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun' => 'required|digits:4',
            'jumlah_siswa' => 'required|numeric',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update([
            'tahun' => $request->tahun,
            'jumlah_siswa' => $request->jumlah_siswa,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        Siswa::findOrFail($id)->delete();
        return redirect()->route('siswa.index')->with('success', 'Data berhasil dihapus');
    }

    public function show($id)
    {
        $siswa = Siswa::where('id_siswa', $id)->firstOrFail();
        return view('siswa.show', compact('siswa'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()->route('siswa.index')->with('success', 'Data berhasil diimport!');
    }

}
