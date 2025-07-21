<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Peminjam;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    $barangs = Barang::where('stok', '>', 0)->get();
    return view('frontend.index', compact('barangs'));
});

Route::post('/pinjam', function (Request $request) {
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'nim_nip' => 'required|string|max:100',
        'barang_id' => 'required|exists:barangs,id',
        'jumlah' => 'required|integer|min:1',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        'keterangan' => 'nullable|string',
    ]);

    $barang = Barang::findOrFail($validated['barang_id']);

    if ($validated['jumlah'] > $barang->stok) {
        return back()->withErrors(['jumlah' => 'Jumlah melebihi stok yang tersedia.'])->withInput();
    }


    // simpan peminjaman
    Peminjam::create([
        'nama' => $validated['nama'],
        'nim_nip' => $validated['nim_nip'],
        'barang_id' => $validated['barang_id'],
        'jumlah' => $validated['jumlah'],
        'tanggal_pinjam' => $validated['tanggal_pinjam'],
        'tanggal_kembali' => $validated['tanggal_kembali'],
        'status' => 'menunggu', // ⬅️ default
        'keterangan' => $validated['keterangan'],
    ]);

    return redirect('/')->with('success', 'Peminjaman berhasil disimpan!');
})->name('pinjam.store');


// Menampilkan form pengembalian
Route::get('/kembalikan', function () {
    $barangs = \App\Models\Barang::all();
    return view('frontend.kembalikan', compact('barangs'));
})->name('kembalikan.form');

// Proses pengembalian
Route::post('/kembalikan', function (\Illuminate\Http\Request $request) {
    $data = $request->validate([
        'nama' => 'required|string',
        'barang_id' => 'required|exists:barangs,id',
        'jumlah' => 'required|integer|min:1',
    ]);

    $pinjam = \App\Models\Peminjam::where('nama', $data['nama'])
        ->where('barang_id', $data['barang_id'])
        ->where('status', 'dipinjam')
        ->first();

    if (!$pinjam) {
        return back()->withErrors(['Barang belum dipinjam atau sudah dikembalikan'])->withInput();
    }

    if ($data['jumlah'] > $pinjam->jumlah) {
        return back()->withErrors(['Jumlah pengembalian melebihi jumlah yang dipinjam'])->withInput();
    }

    // Update status & tambah stok
    $pinjam->update(['status' => 'dikembalikan']);
    $pinjam->barang->increment('stok', $data['jumlah']);

    return redirect('/')->with('success', 'Barang berhasil dikembalikan!');
})->name('kembalikan.store');
