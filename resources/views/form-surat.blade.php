@extends('layouts.app')

@section('content')

<div class="card shadow-lg" style="max-width: 750px; margin:auto; border-radius:18px; overflow:hidden;">

    <!-- HEADER GRADIASI -->
    <div class="card-header text-white fw-bold"
        style="background: linear-gradient(120deg, #0099cc, #00d4b0); font-size:20px;">
        Tambah Surat Pengantar
    </div>

    <div class="card-body p-4">

        <form action="{{ route('surat.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Nomor Surat</label>
                <input type="text" name="no_surat" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Alamat</label>
                <input type="text" name="alamat" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Status Perkawinan</label>
                <select name="status_kawin" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option>Belum Kawin</option>
                    <option>Kawin</option>
                    <option>Cerai</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Pelayanan</label>
                <input type="text" name="pelayanan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Pekerjaan</label>
                <input type="text" name="pekerjaan" class="form-control" required>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="/surat" class="btn btn-secondary px-4">Kembali</a>

                <button class="btn text-white px-4"
                    style="background: linear-gradient(120deg, #0099cc, #00d4b0); font-weight:700;">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

@endsection
