@extends('layouts.app')
@section('navbar_home')
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ url('/home') }}">Home</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link text-dark" href="/home/profile">{{ __('Profile') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-dark active" href="{{ route('logout') }}"
                onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    @endguest
@endsection



@section('content')
    @if (session('status'))
        <h4 class="alert alert-warning mb-2"> {{ session('status') }} </h4>
    @endif

    <script>
        function confirmSubmission() {
            // Menggunakan fungsi bawaan JavaScript confirm untuk menampilkan pesan konfirmasi
            var confirmation = confirm("Apakah data yang Anda masukkan sudah benar?");

            // Jika pengguna mengklik "Iya sudah"
            if (confirmation) {
                // Lakukan submit form
                document.getElementById("carForm").submit();
            } else {
                // Jika pengguna mengklik "Masih belum", batalkan submit form
                return false;
            }
        }
    </script>

<div class="container">
    <div class="card rounded" id="dummyCarsContent">
        <div class="card">
            <div class="card-header">
                <h4 class="text-lg font-semibold">Edit Cars
                    <a href="{{ route('cars') }}" class="btn btn-sm btn-error float-end">Back</a>
                </h4>
            </div>
        </div>
        <div class="card-body">
            <!-- Edit Car Form -->
            <form method="POST" action="{{ url('/home/cars/update_cars/' . $key) }}">
                @csrf
                @method('PUT')

                <!-- Hidden field for seller's email -->
                <input type="hidden" name="email_penjual" value="{{ auth()->user()->email }}">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Merk:</label>
                            <input type="text" name="merk" value="{{ $editdata['merk'] }}" class="form-control"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Model:</label>
                            <input type="text" name="model" value="{{ $editdata['model'] }}" class="form-control"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Tahun Pembuatan:</label>
                            <input type="number" name="tahun_pembuatan" value="{{ $editdata['tahun_pembuatan'] }}"
                                class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Kondisi (Baru/Bekas):</label>
                            <select name="kondisi" class="form-control" required>
                                <option value="Baru" {{ $editdata['kondisi'] === 'Baru' ? 'selected' : '' }}>Baru</option>
                                <option value="Bekas" {{ $editdata['kondisi'] === 'Bekas' ? 'selected' : '' }}>Bekas</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Bahan Bakar:</label>
                            <select name="bahan_bakar" class="form-control" required>
                                <option value="Bensin (Gasoline)" {{ $editdata['bahan_bakar'] === 'Bensin (Gasoline)' ? 'selected' : '' }}>Bensin (Gasoline)</option>
                                <option value="Solar (Diesel)" {{ $editdata['bahan_bakar'] === 'Solar (Diesel)' ? 'selected' : '' }}>Solar (Diesel)</option>
                                <option value="Gas alam (CNG)" {{ $editdata['bahan_bakar'] === 'Gas alam (CNG)' ? 'selected' : '' }}>Gas alam (CNG)</option>
                                <option value="Listrik (Electricity)" {{ $editdata['bahan_bakar'] === 'Listrik (Electricity)' ? 'selected' : '' }}>Listrik (Electricity)</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Transmisi:</label>
                            <select name="transmisi" class="form-control" required>
                                <option value="Matic" {{ $editdata['transmisi'] === 'Matic' ? 'selected' : '' }}>Matic</option>
                                <option value="Manual" {{ $editdata['transmisi'] === 'Manual' ? 'selected' : '' }}>Manual</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Warna:</label>
                            <input type="text" name="warna" value="{{ $editdata['warna'] }}" class="form-control"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Harga:</label>
                            <input type="text" name="harga" value="{{ $editdata['harga'] }}" class="form-control"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Deskripsi Tambahan (Jika tidak, isi "-"):</label>
                            <input type="text" name="deskripsi" value="{{ $editdata['deskripsi'] }}"
                                class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Kontak Penjual (WA):</label>
                            <input type="text" name="kontak_penjual" value="{{ $editdata['kontak_penjual'] }}"
                                class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-accent btn-wide" onclick="return confirmSubmission()">Update
                        Cars</button>
                </div>
                <div class="form-group text-center">
                    <button type="reset" class="btn btn-sm btn-outline btn-error ">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
