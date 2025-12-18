@extends('layouts.app')

@section('content')

<div class="card shadow-sm border-0 rounded-4">

    <div class="card-header text-white rounded-top-4"
         style="background: linear-gradient(120deg, #0099cc, #00d4b0);">
        <h5 class="mb-0">
            <i class="bi bi-person-vcard-fill me-2"></i> Informasi Warga
        </h5>
    </div>

    <div class="card-body p-4">

        <table class="table table-bordered align-middle">
    <tbody>

        {{-- ✅ DATA SENSITIF – ADMIN ONLY --}}
        @if(auth()->user()->role === 'admin')

        <tr>
            <th class="bg-light fw-bold" style="width:200px;">NIK</th>
            <td>{{ $warga->nik }}</td>
        </tr>

        <tr>
            <th class="bg-light fw-bold">No KK</th>
            <td>{{ $warga->no_kk }}</td>
        </tr>

        <tr>
            <th class="bg-light fw-bold">No HP</th>
            <td>{{ $warga->no_hp }}</td>
        </tr>

        {{-- TANGGAL & AGAMA KHUSUS ADMIN --}}
        <tr>
            <th class="bg-light fw-bold">Tanggal Lahir</th>
            <td>{{ $warga->tanggal_lahir }}</td>
        </tr>

        <tr>
            <th class="bg-light fw-bold">Agama</th>
            <td>{{ $warga->agama }}</td>
        </tr>

        @else
        {{-- TAMPILAN JIKA BUKAN ADMIN --}}
        <tr>
            <th class="bg-light fw-bold">Data Sensitif</th>
            <td class="text-muted fst-italic">
                <i class="bi bi-lock-fill me-1"></i>
                Hanya dapat dilihat oleh Admin
            </td>
        </tr>
        @endif


        {{-- ✅ DATA UMUM --}}
        <tr>
            <th class="bg-light fw-bold">Nama</th>
            <td>{{ $warga->name }}</td>
        </tr>

        <tr>
            <th class="bg-light fw-bold">Tempat Lahir</th>
            <td>{{ $warga->tempat_lahir }}</td>
        </tr>

        <tr>
            <th class="bg-light fw-bold">Jenis Kelamin</th>
            <td>{{ $warga->jenis_kelamin }}</td>
        </tr>

        <tr>
            <th class="bg-light fw-bold">Alamat</th>
            <td>{{ $warga->alamat }}</td>
        </tr>

    </tbody>
</table>


        <a href="{{ url('/data-warga') }}" class="btn btn-secondary mt-3">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
        </a>

    </div>
</div>

@endsection
