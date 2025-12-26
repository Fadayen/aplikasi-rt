@extends('layouts.app')

@section('content')

<style>
.profile-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0px 4px 20px rgba(0,0,0,0.06);
    border: none;
    overflow: hidden;
}

.profile-header {
    background: linear-gradient(120deg, #0099cc, #00d4b0);
    padding: 22px 30px;
    color: #fff;
}

.profile-header h3 {
    margin: 0;
    font-weight: 800;
    font-size: 22px;
}

.profile-body {
    padding: 30px;
}

.profile-table th {
    width: 260px;
    font-weight: 600;
    background: #f7f9fc;
}

.profile-table td {
    background: #fff;
}
</style>

<div class="container mt-4">

    <div class="profile-card">

        <!-- ✅ HEADER GRADIENT -->
        <div class="profile-header d-flex align-items-center">
            <i class="bi bi-person-badge fs-4 me-2"></i>
            <h3>Profil Pengguna</h3>
        </div>

        <!-- BODY -->
        <div class="profile-body">

            <table class="table profile-table align-middle">
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ Auth::user()->name }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ Auth::user()->email }}</td>
                </tr>

                <tr>
                    <th>Role</th>
                    <td>
                        <span class="badge bg-primary">
                            {{ ucfirst(Auth::user()->role) }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Nomor Kartu Keluarga</th>
                    <td>{{ Auth::user()->no_kk }}</td>
                </tr>

                <tr>
                    <th>NIK</th>
                    <td>{{ Auth::user()->nik }}</td>
                </tr>

                <tr>
                    <th>Tempat Lahir</th>
                    <td>{{ Auth::user()->tempat_lahir }}</td>
                </tr>

                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ \Carbon\Carbon::parse(Auth::user()->tanggal_lahir)->format('d M Y') }}</td>
                </tr>

                <tr>
                    <th>Agama</th>
                    <td>{{ Auth::user()->agama }}</td>
                </tr>

                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ Auth::user()->jenis_kelamin }}</td>
                </tr>

                <tr>
                    <th>Nomor HP</th>
                    <td>{{ Auth::user()->no_hp }}</td>
                </tr>

                <tr>
                    <th>Alamat Lengkap</th>
                    <td>{{ Auth::user()->alamat }}</td>
                </tr>
            </table>

                {{-- 🚨 BUTTON GANTI PASSWORD (JIKA PASSWORD SEMENTARA) --}}
@if(Auth::user()->role === 'warga' && Auth::user()->force_password_change)
    <div class="alert alert-warning mt-4 d-flex justify-content-between align-items-center">
        <div>
            <strong>⚠️ Keamanan Akun</strong><br>
            Anda masih menggunakan password sementara.  
            Silakan ganti password untuk keamanan akun.
        </div>

        <a href="{{ route('password.change') }}" class="btn btn-warning fw-bold">
            Ganti Password
        </a>
    </div>
@endif

        </div>
    </div>

</div>

@endsection
