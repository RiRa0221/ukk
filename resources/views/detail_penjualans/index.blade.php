@include('layout.header')
@include('layout.menu')
@include('layout.navbar')

<br><br><br><br><br><br><br>

<div class="container mt-5">
    <h2>Daftar Detail Penjualan</h2>
    <a href="{{ route('detail_penjualans.create') }}" class="btn btn-danger">Tambah Detail Penjualan</a>
    <a href="{{ route('detail_penjualans.pdf') }}" class="btn btn-light">Export To Pdf</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Penjualan</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $penjualan_id => $detailGroup)
                @php
                    $penjualan = $detailGroup->first()->penjualan;
                @endphp
                <tr>
                    <td>{{ $penjualan->pelanggan->nama_pelanggan ?? 'Tidak Ada Data' }}</td>
                    <td>
                        <ul>
                            @foreach($detailGroup as $detail)
                                <li>{{ $detail->produk->nama_produk }} (x{{ $detail->jumlah_produk }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        {{ $detailGroup->sum('jumlah_produk') }}
                    </td>
                    <td>
                        {{ number_format($detailGroup->sum('subtotal'), 0, ',', '.') }}
                    </td>
                    <td>
                        <a href="{{ route('detail_penjualans.show', $penjualan_id) }}" class="btn btn-info">Detail</a>
                        <a href="{{ route('detail_penjualans.edit', $penjualan_id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('detail_penjualans.destroy', $detail->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('layout.footer')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
