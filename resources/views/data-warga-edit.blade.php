@extends('layouts.app')

@section('content')


<div class="card shadow-sm border-0 rounded-4">

    <div class="card-header text-white rounded-top-4"
         style="background: linear-gradient(120deg, #0099cc, #00d4b0);">
        <h5 class="mb-0">
            <i class="bi bi-pencil-square me-2"></i> Form Edit Warga
        </h5>
    </div>

    <div class="card-body p-4">

        <form action="{{ url('/data-warga/' . $warga->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">NIK</label>
                    <input type="text" name="nik" class="form-control" 
                           value="{{ $warga->nik }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" 
                           value="{{ $warga->name }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nomor KK</label>
                    <input type="text" name="no_kk" class="form-control" 
                           value="{{ $warga->no_kk }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" 
                           value="{{ $warga->tanggal_lahir }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="Laki-laki" 
                            {{ $warga->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki
                        </option>
                        <option value="Perempuan" 
                            {{ $warga->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nomor HP</label>
                    <input type="text" name="no_hp" class="form-control" 
                           value="{{ $warga->no_hp }}" required>
                </div>

                <div class="col-md-6 mb-3">
    <label class="form-label fw-semibold">Kategori Rumah</label>
    <select name="jenis_tagihan" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>
        <option value="biasa" {{ $warga->jenis_tagihan == 'biasa' ? 'selected' : '' }}>
            Biasa (Rp 50.000)
        </option>
        <option value="vip" {{ $warga->jenis_tagihan == 'vip' ? 'selected' : '' }}>
            VIP (Rp 100.000)
        </option>
    </select>
</div>




            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="/data-warga" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                </a>

                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-save2 me-1"></i> Simpan Perubahan
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
