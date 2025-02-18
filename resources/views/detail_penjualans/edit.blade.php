@include('layout.header')
@include('layout.menu')
@include('layout.navbar')
<br><br><br><br><br><br><br>

<div class="container mt-5">
    <h2>Edit Detail Penjualan</h2>

    <form action="{{ route('detail_penjualans.update', $detailPenjualans->first()->penjualan_id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="hidden" name="penjualan_id" value="{{ $detailPenjualans->first()->penjualan_id }}">

    <div class="mb-3">
        <label>Penjualan</label>
        <select name="penjualan_id" class="form-control" required disabled>
            @foreach($penjualans as $penjualan)
                <option value="{{ $penjualan->id }}" {{ $detailPenjualans->first()->penjualan_id == $penjualan->id ? 'selected' : '' }}>
                    {{ $penjualan->pelanggan->nama_pelanggan }} - {{ $penjualan->tanggal_penjualan }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3" id="produk-container">
        <label>Produk</label>
        @foreach($detailPenjualans as $index => $detail)
            <div class="produk-row">
                <select name="produk_id[]" class="form-control" required>
                    @foreach($produks as $produk)
                        <option value="{{ $produk->id }}" {{ $detail->produk_id == $produk->id ? 'selected' : '' }}>
                            {{ $produk->nama_produk }} (Stok: {{ $produk->stok }})
                        </option>
                    @endforeach
                </select>
                <input type="number" name="jumlah_produk[]" class="form-control" value="{{ $detail->jumlah_produk }}" required>
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    <a href="{{ route('detail_penjualans.index') }}" class="btn btn-secondary">Batal</a>
</form>

</div>

@include('layout.footer')

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tambah-produk').click(function () {
            let newItem = `<div class="produk-row d-flex gap-2 mb-2">
                <select name="produk_id[]" class="form-control" required>
                    @foreach($produks as $produk)
                        <option value="{{ $produk->id }}">{{ $produk->nama_produk }} (Stok: {{ $produk->stok }})</option>
                    @endforeach
                </select>
                <input type="number" name="jumlah_produk[]" class="form-control" min="1" required>
                <button type="button" class="btn btn-danger remove-produk">Hapus</button>
            </div>`;
            $('#produk-container').append(newItem);
        });

        $(document).on('click', '.remove-produk', function () {
            $(this).closest('.produk-row').remove();
        });
    });
</script>

</body>
</html>
