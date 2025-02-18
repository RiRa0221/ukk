@include('layout.header')
@include('layout.menu')
@include('layout.navbar')
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="container mt-5">
    <h2>Detail Penjualan</h2>

    <table class="table">
        <tr>
            <th>Penjualan Tanggal</th>
            <td>{{ $detailPenjualans->first()->penjualan->tanggal_penjualan }}</td>
        </tr>

        <tr>
            <th>Produk</th>
            <td>
                @foreach ($detailPenjualans as $detail)
                    <p>{{ $detail->produk->nama_produk }} - {{ $detail->jumlah_produk }} - {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                @endforeach
            </td>
        </tr>

        <tr>
            <th>Total Harga</th>
            <td>{{ number_format($detailPenjualans->sum('subtotal'), 0, ',', '.') }}</td>
        </tr>
    </table>

    <a href="{{ route('detail_penjualans.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('detail_penjualans.edit', $detailPenjualans->first()->penjualan_id) }}" class="btn btn-warning">Edit</a>

    <form action="{{ route('detail_penjualans.destroy', $detailPenjualans->first()->penjualan_id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
    </form>
</div>

@include('layout.footer')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
