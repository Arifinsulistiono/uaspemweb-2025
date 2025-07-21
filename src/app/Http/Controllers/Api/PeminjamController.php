<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Peminjam;
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    public function index()
    {
        $data = Peminjam::with('barang')->latest()->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'nim_nip' => 'required|string',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($barang->stok < $request->jumlah) {
            return response()->json(['message' => 'Stok tidak mencukupi'], 400);
        }

        $peminjam = Peminjam::create([
            'nama' => $request->nama,
            'nim_nip' => $request->nim_nip,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'dipinjam',
            'keterangan' => $request->keterangan,
        ]);

        $barang->stok -= $request->jumlah;
        $barang->save();

        return response()->json([
            'message' => 'Peminjaman berhasil dicatat',
            'data' => $peminjam->load('barang'),
        ], 201);
    }

    public function kembali($id)
    {
        $peminjam = Peminjam::findOrFail($id);

        if ($peminjam->status === 'dikembalikan') {
            return response()->json(['message' => 'Barang sudah dikembalikan'], 400);
        }

        $peminjam->status = 'dikembalikan';
        $peminjam->tanggal_kembali = now();
        $peminjam->save();

        $barang = $peminjam->barang;
        $barang->stok += $peminjam->jumlah;
        $barang->save();

        return response()->json(['message' => 'Barang berhasil dikembalikan']);
    }
}
