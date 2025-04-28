<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembelian;
use App\Models\Barang;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::with('barang')->where('user_id', Auth::id())->get();
        return view('dashboard', compact('pembelians'));
    }

    public function beli(string $id)
    {
        $barang = Barang::findOrFail($id);

        // Cek kalau barang sudah terjual
        if ($barang->status === 'terjual') {
            return redirect()->back()->with('error', 'Barang sudah terjual!');
        }

        // Cek kalau user mau beli barang milik sendiri
        if ($barang->user_id === Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak bisa membeli barang Anda sendiri!');
        }

        // Cek kalau user sudah beli barang ini
        if (Pembelian::where('user_id', Auth::id())->where('barang_id', $barang->id)->exists()) {
            return redirect()->back()->with('error', 'Anda sudah membeli barang ini!');
        }

        // Proses pembelian
        Pembelian::create([
            'user_id' => Auth::id(),
            'barang_id' => $barang->id,
        ]);

        // Update status barang ke 'terjual'
        $barang->update([
            'status' => 'terjual',
        ]);

        return redirect()->route('barangs.index')->with('success', 'Pembelian berhasil!');
    }

    public function destroy(string $id)
    {
        $pembelian = Pembelian::findOrFail($id);

        // Cek user yang hapus adalah pemilik pembelian
        if ($pembelian->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        // Kembalikan status barang ke tersedia saat pembelian dihapus
        $barang = Barang::find($pembelian->barang_id);
        if ($barang) {
            $barang->update(['status' => 'tersedia']);
        }

        $pembelian->delete();

        return redirect()->route('dashboard')->with('success', 'Pembelian dibatalkan');
    }
}
