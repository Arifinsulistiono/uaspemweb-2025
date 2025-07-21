<!DOCTYPE html>
<html>
<head>
    <title>Form Pengembalian Barang</title>
    <link href="{{ asset('front/vendors/bootstrap/bootstrap.min.css') }}" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <h2>Form Pengembalian Barang</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('kembalikan.store') }}">
            @csrf
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Barang yang Dikembalikan:</label>
                <select name="barang_id" class="form-control" required>
                    <option disabled selected>-- Pilih Barang --</option>
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Jumlah:</label>
                <input type="number" name="jumlah" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success mt-3">Kembalikan Barang</button>
        </form>
    </div>
</body>
</html>
