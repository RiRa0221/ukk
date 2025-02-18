@include('layout.header')
@include('layout.menu')
@include('layout.navbar')
<br><br><br><br><br><br><br>

<div class="container mt-5">
    <h2>Tambah Detail Penjualan</h2>

    <form action="{{ route('detail_penjualans.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Penjualan</label>
            <select name="penjualan_id" class="form-control" required>
                @foreach($penjualans as $penjualan)
                <option value="{{ $penjualan->id }}">
                    {{ $penjualan->pelanggan->nama_pelanggan }} - {{ $penjualan->tanggal_penjualan }}
                </option>
                @endforeach
            </select>
        </div>

        <div id="produk-container">
            <div class="produk-item d-flex gap-2 mb-2">
                <select name="produk_id[]" class="form-control" required>
                    @foreach($produks as $produk)
                        <option value="{{ $produk->id }}">{{ $produk->nama_produk }} (Stok: {{ $produk->stok }})</option>
                    @endforeach
                </select>
                <input type="number" name="jumlah_produk[]" class="form-control" min="1" required>
                <button type="button" class="btn btn-danger remove-produk">Hapus</button>
            </div>
        </div>

        <button type="button" id="tambah-produk" class="btn btn-primary">Tambah Produk</button>
        <br><br>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('detail_penjualans.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

@include('layout.footer')

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        $('#tambah-produk').click(function () {
            let newItem = `<div class="produk-item d-flex gap-2 mb-2">
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
            $(this).parent().remove();
        });
    });
</script>

</body>
</html>
