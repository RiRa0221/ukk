@include('layout.header')

@include('layout.menu')

@include('layout.navbar')
<br><br><br><br><br><br><br>

<div class="container-fluid p-4">
    <!-- Ringkasan Penjualan -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Penjualan</h5>
                    <h3>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Total Produk Terjual</h5>
                    <h3>{{ $totalProdukTerjual }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5>Total Transaksi</h5>
                    <h3>{{ $totalPenjualan }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5>Pendapatan Hari Ini</h5>
                    <h3>Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Transaksi Terbaru -->
    <div class="mt-4">
        <h4>Transaksi Terbaru</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksiTerbaru as $index => $penjualan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $penjualan->pelanggan ? $penjualan->pelanggan->nama_pelanggan : 'Tidak Ada Pelanggan' }}</td>
                        <td>{{ \Carbon\Carbon::parse($penjualan->tanggal_penjualan)->format('d M Y') }}</td>
                        <td>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                        <td><a href="{{ route('penjualans.show', $penjualan->id) }}" class="btn btn-primary btn-sm">Detail</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('layout.footer')
