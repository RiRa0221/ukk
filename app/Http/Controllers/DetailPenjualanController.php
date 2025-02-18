<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;

class DetailPenjualanController extends Controller
{
    public function index()
{
    // Ambil data DetailPenjualan, lalu kelompokkan berdasarkan penjualan_id
    $details = DetailPenjualan::with(['penjualan.pelanggan', 'produk'])
                ->get()
                ->groupBy('penjualan_id');

    return view('detail_penjualans.index', compact('details'));
}

    public function create()
    {
        $penjualans = Penjualan::all();
        $produks = Produk::all();
        return view('detail_penjualans.create', compact('penjualans', 'produks'));
    }

    public function store(Request $request)
{
    $request->validate([
        'penjualan_id' => 'required|exists:penjualans,id',
        'produk_id' => 'required|array',
        'produk_id.*' => 'exists:produks,id',
        'jumlah_produk' => 'required|array',
        'jumlah_produk.*' => 'integer|min:1',
    ]);

    $penjualan_id = $request->penjualan_id;
    $produk_ids = $request->produk_id;
    $jumlah_produk_list = $request->jumlah_produk;

    foreach ($produk_ids as $index => $produk_id) {
        $produk = Produk::findOrFail($produk_id);
        $jumlah_produk = $jumlah_produk_list[$index];

        // Cek stok
        if ($produk->stok < $jumlah_produk) {
            return redirect()->back()->withErrors("Stok produk {$produk->nama} tidak mencukupi.");
        }

        // Kurangi stok produk
        $produk->stok -= $jumlah_produk;
        $produk->save();

        // Hitung subtotal
        $subtotal = $produk->harga * $jumlah_produk;

        // Simpan detail penjualan
        DetailPenjualan::create([
            'penjualan_id' => $penjualan_id,
            'produk_id' => $produk_id,
            'jumlah_produk' => $jumlah_produk,
            'subtotal' => $subtotal,
        ]);
    }

    // Update total harga di Penjualan
    $this->updateTotalHarga($penjualan_id);

    return redirect()->route('detail_penjualans.index')->with('success', 'Detail Penjualan berhasil ditambahkan.');
}


public function edit($penjualan_id)
{
    $detailPenjualans = DetailPenjualan::where('penjualan_id', $penjualan_id)->get();

    if ($detailPenjualans->isEmpty()) {
        abort(404, "Detail Penjualan tidak ditemukan.");
    }

    $penjualans = Penjualan::all();
    $produks = Produk::all();

    return view('detail_penjualans.edit', compact('detailPenjualans', 'penjualans', 'produks'));
}



public function update(Request $request, $penjualan_id)
{
    $request->validate([
        'produk_id' => 'required|array|min:1',
        'produk_id.*' => 'exists:produks,id',
        'jumlah_produk' => 'required|array|min:1',
        'jumlah_produk.*' => 'integer|min:1',
    ]);

    // Ambil semua detail penjualan lama berdasarkan penjualan_id
    $detailLama = DetailPenjualan::where('penjualan_id', $penjualan_id)->get();

    // Kembalikan stok produk lama sebelum update
    foreach ($detailLama as $detail) {
        $produk = Produk::findOrFail($detail->produk_id);
        $produk->stok += $detail->jumlah_produk;
        $produk->save();
    }

    // Hapus detail lama sebelum menambahkan yang baru
    DetailPenjualan::where('penjualan_id', $penjualan_id)->delete();

    // Simpan data baru
    $produkIds = $request->produk_id;
    $jumlahProduks = $request->jumlah_produk;

    foreach ($produkIds as $index => $produkId) {
        $produk = Produk::findOrFail($produkId);

        // Cek stok cukup
        if ($produk->stok < $jumlahProduks[$index]) {
            return redirect()->back()->withErrors('Stok produk tidak mencukupi.');
        }

        // Kurangi stok produk
        $produk->stok -= $jumlahProduks[$index];
        $produk->save();

        // Hitung subtotal
        $subtotal = $produk->harga * $jumlahProduks[$index];

        // Simpan detail baru
        DetailPenjualan::create([
            'penjualan_id' => $penjualan_id,
            'produk_id' => $produkId,
            'jumlah_produk' => $jumlahProduks[$index],
            'subtotal' => $subtotal,
        ]);
    }

    // Update total harga di Penjualan
    $penjualan = Penjualan::findOrFail($penjualan_id);
    $penjualan->update(['total_harga' => DetailPenjualan::where('penjualan_id', $penjualan_id)->sum('subtotal')]);

    return redirect()->route('detail_penjualans.index')->with('success', 'Detail Penjualan berhasil diperbarui.');
}


public function show($id)
{
    // Temukan semua detail penjualan berdasarkan penjualan_id
    $detailPenjualans = DetailPenjualan::with(['produk'])
        ->where('penjualan_id', $id)
        ->get();

    if ($detailPenjualans->isEmpty()) {
        return redirect()->route('detail_penjualans.index')->withErrors('Detail Penjualan tidak ditemukan.');
    }

    return view('detail_penjualans.show', compact('detailPenjualans'));
}

    public function destroy($id)
{
    // Temukan satu detail penjualan untuk mendapatkan penjualan_id
    $detailPenjualan = DetailPenjualan::findOrFail($id);

    // Ambil semua detail penjualan yang memiliki penjualan_id yang sama
    $details = DetailPenjualan::where('penjualan_id', $detailPenjualan->penjualan_id)->get();

    // Kembalikan stok produk sebelum menghapus
    foreach ($details as $detail) {
        $produk = Produk::find($detail->produk_id);
        if ($produk) {
            $produk->stok += $detail->jumlah_produk;
            $produk->save();
        }
    }

    // Hapus semua detail penjualan terkait penjualan_id ini
    DetailPenjualan::where('penjualan_id', $detailPenjualan->penjualan_id)->delete();

    // Update total harga di tabel Penjualan setelah semua detail dihapus
    $this->updateTotalHarga($detailPenjualan->penjualan_id);

    return redirect()->route('detail_penjualans.index')->with('success', 'Semua Detail Penjualan berhasil dihapus.');
}



    private function updateTotalHarga($penjualan_id)
    {
        $penjualan = Penjualan::findOrFail($penjualan_id);
        $totalHarga = DetailPenjualan::where('penjualan_id', $penjualan_id)->sum('subtotal');

        $penjualan->update(['total_harga' => $totalHarga]);
    }
}
