<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{

    public function index()
    {
        $wargas = Warga::orderBy('nama')->get();
        return view('warga.index', compact('wargas'));
    }

    public function create()
    {
        return view('warga.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|unique:wargas,nik|max:20',
            'nama' => 'required|string|max:255',
        ]);

        Warga::create($validated);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function edit(Warga $warga)
    {
        return view('warga.edit', compact('warga'));
    }

    public function update(Request $request, Warga $warga)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:20|unique:wargas,nik,'.$warga->id,
            'nama' => 'required|string|max:255',
        ]);

        $warga->update($validated);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
