@extends('layouts.app')

@section('content')

<div class="container" style="max-width: 650px;">

    <div class="card shadow-sm" style="border-radius: 12px; overflow:hidden;">

    <div class="card-header text-white fw-semibold"
         style="background: linear-gradient(120deg, #0099cc, #00d4b0); font-size:18px;">
        Edit Data Surat
    </div>

    <div class="card-body p-4">


    <div class="card shadow-sm" style="border-radius: 12px;">
        <div class="card-body p-4">

            <form action="{{ route('surat.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="fw-semibold">Nomor Surat</label>
                    <input type="text" name="no_surat" class="form-control form-control-lg" 
                           value="{{ $data->no_surat }}" required>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Nama Lengkap</label>
                    <input type="text" name="username" class="form-control form-control-lg" 
                           value="{{ $data->username }}" required>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Alamat</label>
                    <input type="text" name="alamat" class="form-control form-control-lg" 
                           value="{{ $data->alamat }}" required>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control form-control-lg" 
                           value="{{ $data->tanggal }}" required>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Status Perkawinan</label>
                    <select name="status_kawin" class="form-select form-select-lg" required>
                        <option value="Belum Kawin" {{ $data->status_kawin == 'Belum Kawin' ? 'selected' : '' }}>
                            Belum Kawin
                        </option>
                        <option value="Sudah Kawin" {{ $data->status_kawin == 'Sudah Kawin' ? 'selected' : '' }}>
                            Sudah Kawin
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Pelayanan</label>
                    <input type="text" name="pelayanan" class="form-control form-control-lg" 
                           value="{{ $data->pelayanan }}" required>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="form-control form-control-lg" 
                           value="{{ $data->pekerjaan }}" required>
                </div>

                {{-- HANYA ADMIN YANG BOLEH MENGUBAH STATUS --}}
                @if(auth()->user()->role === 'admin')
                    <div class="mb-4">
                        <label class="fw-semibold">Status</label>
                        <select name="status" class="form-select form-select-lg">
                            <option value="pending" {{ $data->status == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="selesai" {{ $data->status == 'selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>
                        </select>
                    </div>
                @else
                    <!-- Warga tidak boleh edit status -->
                    <input type="hidden" name="status" value="{{ $data->status }}">
                @endif

                <div class="d-flex justify-content-between">
                    <a href="{{ route('surat.index') }}" class="btn btn-secondary px-4">Kembali</a>
                    <button class="btn btn-primary px-4">Update</button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
