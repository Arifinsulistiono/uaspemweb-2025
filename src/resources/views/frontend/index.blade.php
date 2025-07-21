<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Form Peminjaman Barang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('front/vendors/bootstrap/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('front/css/style.css') }}" rel="stylesheet" />
    <a href="{{ route('kembalikan.form') }}" class="btn btn-secondary">Form Pengembalian</a>
  </head>
  <body>

    <!-- Navigation -->
    <header class="header" id="header">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
          <a class="navbar-brand" href="/">
            <strong>Peminjaman Barang</strong>
          </a>
        </nav>
      </div>
    </header>

    <!-- Hero -->
    <section class="hero" id="hero">
      <div class="container text-center">
        <h1 class="display-4">Form Peminjaman Barang</h1>
        <p class="lead">Silakan isi form di bawah ini untuk melakukan peminjaman.</p>
      </div>
    </section>

    <!-- Form Section -->
    <section class="container my-5">
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

      <form method="POST" action="{{ route('pinjam.store') }}">
        @csrf
        <div class="form-group">
          <label>Nama:</label>
          <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="form-group">
          <label>NIM/NIP:</label>
          <input type="text" name="nim_nip" class="form-control" required>
        </div>

        <div class="form-group">
          <label>Barang:</label>
          <select name="barang_id" class="form-control" required>
            <option disabled selected>-- Pilih Barang --</option>
            @foreach($barangs as $barang)
              <option value="{{ $barang->id }}">{{ $barang->nama }} (Stok: {{ $barang->stok }})</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Jumlah:</label>
          <input type="number" name="jumlah" class="form-control" required>
        </div>

        <div class="form-group">
          <label>Tanggal Pinjam:</label>
          <input type="date" name="tanggal_pinjam" class="form-control" required>
        </div>

        <div class="form-group">
          <label>Tanggal Kembali:</label>
          <input type="date" name="tanggal_kembali" class="form-control" required>
        </div>

        <div class="form-group">
          <label>Keterangan:</label>
          <textarea name="keterangan" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan Peminjaman</button>
      </form>
    </section>

    <!-- Footer -->
    <footer class="bg-dark py-4 text-white text-center">
      <p class="mb-0">© {{ date('Y') }} - Sistem Peminjaman Barang</p>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('front/vendors/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front/js/script.js') }}"></script>
  </body>
</html>
