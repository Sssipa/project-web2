<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Barang;
use App\Models\Kategori;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('kategori')->get(); // Load relasi kategori
        return view('barangs.index', compact('barangs'));
    }

    public function show(string $id)
    {
        $barang = Barang::with('kategori')->findOrFail($id);
        return view('barangs.show', compact('barang'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('barangs.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $gambarPath = $request->hasFile('gambar')
            ? $request->file('gambar')->store('uploads', 'public')
            : null;

        Barang::create([
            'user_id' => Auth::id(),
            'nama' => $validated['nama'],
            'harga' => $validated['harga'],
            'deskripsi' => $validated['deskripsi'],
            'status' => 'tersedia',
            'gambar' => $gambarPath,
            'kategori_id' => $validated['kategori_id'],
        ]);

        return redirect()->route('barangs.jual')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        $kategoris = Kategori::all();
        return view('barangs.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:tersedia,terjual',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $barang = Barang::findOrFail($id);

        if ($request->hasFile('gambar')) {
            if ($barang->gambar) {
                Storage::delete('public/' . $barang->gambar);
            }
            $gambarPath = $request->file('gambar')->store('uploads', 'public');
            $barang->update(['gambar' => $gambarPath]);
        }

        $barang->update([
            'nama' => $validated['nama'],
            'harga' => $validated['harga'],
            'deskripsi' => $validated['deskripsi'],
            'status' => $validated['status'],
            'kategori_id' => $validated['kategori_id'],
        ]);

        return redirect()->route('barangs.jual')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->gambar) {
            Storage::delete('public/' . $barang->gambar);
        }

        $barang->delete();

        return redirect()->route('barangs.jual')->with('success', 'Barang berhasil dihapus');
    }

    public function jual()
    {
        $barangs = Barang::where('user_id', Auth::id())->with('kategori')->get();
        return view('barangs.jual', compact('barangs'));
    }
}
