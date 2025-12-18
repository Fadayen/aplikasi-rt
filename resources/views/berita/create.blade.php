@extends('layouts.app')

@section('content')

<div class="container mt-4" style="max-width: 850px;">
    <a href="/berita" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="card shadow-lg" style="border-radius: 18px; overflow:hidden;">

        <!-- HEADER GRADIASI -->
        <div class="card-header text-white fw-bold"
             style="background: linear-gradient(120deg, #0099cc, #00d4b0); font-size: 20px;">
            Tambah Berita
        </div>

        <div class="card-body p-4">

            <!-- Error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin:0; padding-left:18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Isi</label>
                    <textarea name="isi" class="form-control" rows="5" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Headline</label>
                    <input type="text" name="headline" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Sumber / Penulis</label>
                    <input type="text" name="penulis" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                </div>

                <button class="btn text-white w-100 py-2 fw-bold mt-3"
                    style="background: linear-gradient(120deg, #0099cc, #00d4b0); border-radius:10px;">
                    + Tambah Berita
                </button>

            </form>

        </div>
    </div>

</div>

@endsection
