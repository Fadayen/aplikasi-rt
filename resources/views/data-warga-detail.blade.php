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
                <tr>
                    <th class="bg-light fw-bold">Tanggal Lahir</th>
                    <td>{{ $warga->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <th class="bg-light fw-bold">Agama</th>
                    <td>{{ $warga->agama }}</td>
                </tr>
            @else
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

        {{-- 🔘 TOMBOL AKSI --}}
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ url('/data-warga') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali
            </a>

            @if(auth()->user()->role === 'admin')
                <button class="btn btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#resetPasswordModal">
                    <i class="bi bi-key-fill me-1"></i> Reset Password
                </button>
            @endif
        </div>

    </div>
</div>

{{-- ✅ MODAL RESET PASSWORD --}}
@if(auth()->user()->role === 'admin')
<div class="modal fade" id="resetPasswordModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('admin.reset-password', $warga->id) }}">
      @csrf

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            <i class="bi bi-shield-lock-fill me-1"></i>
            Reset Password Warga
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <p>
            Password akan direset untuk:
            <strong>{{ $warga->name }}</strong>
          </p>

          <div class="mb-3">
            <label class="form-label">Password Admin</label>
            <input type="password"
                   name="admin_password"
                   class="form-control"
                   required>
          </div>

          <div class="alert alert-warning small">
            ⚠️ Password lama warga akan diganti.
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-danger">Reset Password</button>
        </div>
      </div>

    </form>
  </div>
</div>
@endif

@endsection
