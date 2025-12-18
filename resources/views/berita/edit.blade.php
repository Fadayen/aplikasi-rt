@extends('layouts.app')

@section('content')

<div class="container mt-4" style="max-width: 750px;">

    <div class="card shadow-lg" style="border-radius: 18px; overflow:hidden;">

        <!-- HEADER GRADIASI -->
        <div class="card-header text-white fw-bold"
            style="background: linear-gradient(120deg, #0099cc, #00d4b0); font-size: 20px;">
            Edit Berita
        </div>

        <div class="card-body p-4">

            <!-- Validasi Error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin:0; padding-left:18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('berita.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- JUDUL --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul</label>
                    <input type="text" name="judul" class="form-control" value="{{ $data->judul }}" required>
                </div>

                {{-- PENULIS --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="{{ $data->penulis }}" required>
                </div>

                {{-- ISI --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Isi Berita</label>
                    <textarea name="isi" class="form-control" rows="6" required>{{ $data->isi }}</textarea>
                </div>

                {{-- GAMBAR --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar (Opsional)</label><br>

                    @if ($data->gambar)
                        <img src="{{ asset('storage/' . $data->gambar) }}" 
                             alt="Gambar Berita"
                             style="width:150px; border-radius:10px; margin-bottom:8px;">
                        <br>
                    @endif

                    <input type="file" name="gambar" class="form-control">
                </div>

                {{-- BUTTON --}}
                <div class="d-flex justify-content-between mt-4">

                    <a href="/berita" class="btn btn-secondary px-4">
                        Kembali
                    </a>

                    <button type="submit" 
                        class="btn text-white px-4"
                        style="background: linear-gradient(120deg, #0099cc, #00d4b0); font-weight:700;">
                        Update Berita
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
