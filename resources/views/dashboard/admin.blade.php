@extends('layouts.app')

@section('content')

<style>

/* ============================
   RESPONSIVE FIXES
=============================== */

/* ======= HP (≤ 576px) ======= */
@media (max-width: 576px) {

    /* Header besar */
    .big-header-box {
        font-size: 22px;
        padding: 25px 15px;
    }

    /* Title section */
    .section-title {
        font-size: 20px;
        margin-top: 20px;
    }
    .section-line {
        width: 70px;
    }

    /* Card default */
    .card {
        border-radius: 12px !important;
    }

    .card-header {
        font-size: 14px;
        padding: 10px 15px;
    }

    .card-body {
        padding: 15px !important;
    }

    /* Menu kotak */
    .menu-card {
        height: auto;
        padding: 20px 15px;
        margin-bottom: 15px;
    }

    .menu-title {
        font-size: 16px;
    }

    .menu-desc {
        font-size: 12px;
    }

    /* Tabel */
    table.table {
        font-size: 13px;
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    /* Button kecil */
    .btn {
        padding: 6px 10px !important;
        font-size: 13px !important;
    }

    /* Modal */
    .modal-dialog {
        margin: 15px;
    }
    .modal-content {
        border-radius: 10px;
    }

    /* Badge */
    .badge {
        padding: 6px 10px !important;
        font-size: 12px;
    }

    /* Grid */
    .row > [class*="col-"] {
        margin-bottom: 15px;
    }
}

/* ======= Tablet (≤ 768px) ======= */
@media (max-width: 768px) {

    .card-header {
        font-size: 15px;
    }

    .menu-card {
        height: auto;
    }

    .section-title {
        font-size: 22px;
    }

    table.table {
        font-size: 14px;
    }
}

/* ======= Desktop kecil (≤ 992px) ======= */
@media (max-width: 992px) {
    .dashboard-wrapper {
        padding: 20px 10px;
    }
}

</style>


<div class="container mt-4">

     {{-- GLOBAL NOTIFICATION --}}
    @if(session('success'))
<div class="alert alert-success alert-dismissible fade show auto-alert">
    <i class="bi bi-check-circle-fill me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show auto-alert">
    <i class="bi bi-x-circle-fill me-2"></i>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

    <!-- SECTION TITLE -->
    <div class="section-title mt-4">
        DASHBOARD ADMIN
    </div>
    <div class="section-line"></div>

    <!-- ROW 1 -->
    <div class="row g-4">

        <!-- Approval Akun Warga -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <i class="bi bi-person-check me-2"></i> Approval Warga Baru
                </div>
                <div class="card-body">

                    @if($pendingWarga->count() == 0)
                        <p class="text-muted fst-italic">Tidak ada warga baru menunggu persetujuan.</p>
                    @else
                        <ul class="list-group">

                            @foreach ($pendingWarga as $w)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="d-block">{{ $w->name }}</strong>
                                        <small class="text-muted">{{ $w->email }}</small>
                                    </div>

                                    <div class="d-flex gap-2">

                                        <!-- Detail -->
                                        <button class="btn btn-info btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#detailWarga{{ $w->id }}">
                                            <i class="bi bi-eye"></i> Detail
                                        </button>

                                        <!-- Approve -->
                                        <form action="{{ route('admin.users.approve', $w->id) }}" method="POST">
    @csrf
    <button class="btn btn-success btn-sm">
        <i class="bi bi-check2-circle"></i> Approve
    </button>
</form>


                                        <!-- Decline -->
                                        <form action="{{ route('admin.users.decline', $w->id) }}" method="POST"
      onsubmit="return confirm('Yakin ingin menolak user ini?')">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-sm">
        <i class="bi bi-x-circle"></i> Decline
    </button>
</form>

                                    </div>
                                </li>

                                <!-- MODAL DETAIL WARGA -->
                                <div class="modal fade" id="detailWarga{{ $w->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">
                                                    Detail Warga: {{ $w->name }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">

                                                <table class="table table-bordered rounded">
                                                    <tr><th>Nama Lengkap</th><td>{{ $w->name }}</td></tr>
                                                    <tr><th>Email</th><td>{{ $w->email }}</td></tr>
                                                    <tr><th>NIK</th><td>{{ $w->nik }}</td></tr>
                                                    <tr><th>No KK</th><td>{{ $w->no_kk }}</td></tr>
                                                    <tr><th>Alamat</th><td>{{ $w->alamat }}</td></tr>
                                                    <tr><th>No Telepon</th><td>{{ $w->no_hp }}</td></tr>
                                                    <tr><th>Tanggal Registrasi</th><td>{{ $w->created_at }}</td></tr>
                                                </table>

                                            </div>

                                            <div class="modal-footer d-flex justify-content-between">

    <!-- APPROVE -->
    <form action="{{ route('admin.users.approve', $w->id) }}" method="POST">
    @csrf
    <button class="btn btn-success btn-sm">
        <i class="bi bi-check2-circle"></i> Approve
    </button>
</form>


    <!-- DECLINE -->
    <form action="{{ route('admin.users.decline', $w->id) }}" method="POST"
      onsubmit="return confirm('Yakin ingin menolak user ini?')">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-sm">
        <i class="bi bi-x-circle"></i> Decline
    </button>
</form>


    <!-- CLOSE -->
    <button class="btn btn-secondary" data-bs-dismiss="modal">
        Tutup
    </button>

</div>


                                        </div>
                                    </div>
                                </div>
                                <!-- END MODAL -->
                            @endforeach

                        </ul>
                    @endif

                </div>
            </div>
        </div>

        <!-- Surat Pending -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-dark d-flex align-items-center">
                    <i class="bi bi-envelope-exclamation me-2"></i> Surat Pengantar Pending
                </div>
                <div class="card-body">

    @if($pendingSurat->count() == 0)
        <p class="text-muted fst-italic">Tidak ada surat yang menunggu validasi.</p>
    @else
        <ul class="list-group">
            @foreach ($pendingSurat as $s)
                <li class="list-group-item">

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <strong>{{ $s->nama_lengkap }}</strong><br>
                            <small class="text-muted">Menunggu Validasi</small>
                        </div>

                        <div class="d-flex gap-1">

                            {{-- Button Detail --}}
                            <button class="btn btn-secondary btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#detailModal{{ $s->id }}">
                                <i class="bi bi-info-circle"></i> Detail
                            </button>

                            {{-- Button Validasi --}}
                            <a href="/surat/{{ $s->id }}/validasi"
                               class="btn btn-primary btn-sm">
                                <i class="bi bi-check-circle"></i> Validasi
                            </a>

                        </div>
                    </div>

                    {{-- Upload File: boleh RT dan RW --}}
                    @if(in_array(Auth::user()->role, ['rt', 'rw']))
                        <form action="{{ route('surat.upload', $s->id) }}"
                              method="POST" enctype="multipart/form-data"
                              class="border p-2 rounded">
                            @csrf

                            <label class="form-label mb-1">Upload File Surat (PDF)</label>
                            <input type="file" name="file_surat" class="form-control form-control-sm mb-2" required>

                            <button class="btn btn-success btn-sm w-100">
                                Upload PDF
                            </button>
                        </form>
                    @endif

                </li>

                {{-- MODAL DETAIL SURAT --}}
<div class="modal fade" id="detailModal{{ $s->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: 12px;">

            <div class="modal-header bg-primary text-white" style="border-radius: 12px 12px 0 0;">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-file-earmark-text me-2"></i> Detail Surat
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body px-4 py-3">

                <div class="row g-3">

                    <div class="col-md-6">
                        <div class="p-3 shadow-sm bg-light rounded">
                            <p class="m-0"><strong>No. Surat:</strong><br>
                                {{ $s->no_surat ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 shadow-sm bg-light rounded">
                            <p class="m-0"><strong>Nama Lengkap:</strong><br>
                                {{ $s->username ?? $s->user->username ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 shadow-sm bg-light rounded">
                            <p class="m-0"><strong>Alamat:</strong><br>
                                {{ $s->alamat ?? $s->user->alamat ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 shadow-sm bg-light rounded">
                            <p class="m-0"><strong>Tanggal Pengajuan:</strong><br>
                                {{ $s->tanggal ?? ($s->created_at->format('Y-m-d')) }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 shadow-sm bg-light rounded">
                            <p class="m-0"><strong>Status Perkawinan:</strong><br>
                                {{ $s->status_kawin ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 shadow-sm bg-light rounded">
                            <p class="m-0"><strong>Pelayanan:</strong><br>
                                {{ $s->pelayanan ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 shadow-sm bg-light rounded">
                            <p class="m-0"><strong>Pekerjaan:</strong><br>
                                {{ $s->pekerjaan ?? '-' }}
                            </p>
                        </div>
                    </div>

                </div>

                {{-- FILE SURAT --}}
                <div class="mt-4">
                    <h6 class="fw-bold">Dokumen Surat</h6>

                    @if($s->file_surat)
                        <div class="alert alert-success d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            Dokumen sudah diupload.
                            <a href="{{ route('surat.download', $s->id) }}" class="btn btn-sm btn-primary ms-auto">
                                <i class="bi bi-download"></i> Download
                            </a>
                        </div>
                    @else
                        <div class="alert alert-warning d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            Belum ada dokumen.
                        </div>
                    @endif
                </div>

                {{-- FORM UPLOAD DOKUMEN --}}
                <form action="{{ route('surat.upload', $s->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-3">
                        <label class="form-label fw-semibold">Upload Dokumen</label>
                        <input type="file" class="form-control" name="file_surat" required>
                    </div>

                    <button class="btn btn-success mt-3 w-100">
                        <i class="bi bi-upload"></i> Upload Dokumen
                    </button>
                </form>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                <a href="/surat/{{ $s->id }}/validasi" class="btn btn-primary px-4">
                    <i class="bi bi-check-circle"></i> Validasi
                </a>
            </div>

        </div>
    </div>
</div>

            @endforeach
        </ul>
    @endif

</div>


            </div>
        </div>

    </div>

    <!-- ROW 2: Agenda -->
<div class="row g-4 mt-1">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <span><i class="bi bi-calendar-event me-2"></i> Agenda RT</span>
                <a href="/agenda/create" class="btn btn-light btn-sm">+ Tambah Agenda</a>
            </div>
            <div class="card-body">

                @if($agenda->count() == 0)
                    <p class="text-muted fst-italic">Belum ada agenda.</p>
                @else
                    <ul class="list-group">
                        @foreach ($agenda as $a)
                            <li class="list-group-item d-flex justify-content-between align-items-center">

                                <!-- Info Agenda -->
                                <div>
                                    <strong>{{ $a->judul }}</strong><br>
                                    <small class="text-muted">
                                        <i class="bi bi-calendar-check"></i> {{ $a->tanggal }}
                                    </small>
                                </div>

                                <!-- Tombol aksi -->
                                <div class="d-flex gap-2">

                                    <!-- Edit -->
                                    <a href="/agenda/{{ $a->id }}/edit" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <!-- Delete -->
                                    <form action="/agenda/delete/{{ $a->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus agenda ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>

                                </div>

                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>
        </div>
    </div>
</div>

<!-- ROW 3 -->
<div class="row g-4 mt-1">


        <!-- Keuangan -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-cash-coin me-2"></i> Keuangan RT</span>
                    <a href="/keuangan/create" class="btn btn-light btn-sm">+ Tambah</a>
                </div>
                <div class="card-body">

                    <h6>Total Pemasukan:
                        <span class="text-success fw-bold">Rp {{ number_format($totalMasuk) }}</span>
                    </h6>

                    <h6>Total Pengeluaran:
                        <span class="text-danger fw-bold">Rp {{ number_format($totalKeluar) }}</span>
                    </h6>

                </div>
            </div>
        </div>

        <!-- Inventaris -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-archive me-2"></i> Inventaris RT</span>
                    <a href="/inventaris/create" class="btn btn-light btn-sm">+ Tambah Barang</a>
                </div>
                <div class="card-body">

                    @if($inventaris->count() == 0)
                        <p class="text-muted fst-italic">Belum ada inventaris.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($inventaris as $item)
                                <li class="list-group-item d-flex justify-content-between">
                                    {{ $item->nama_barang }}
                                    <span class="badge bg-primary rounded-pill px-3 py-2">
                                        {{ $item->jumlah }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>
            </div>
        </div>

        <!-- ROW 4: Laporan Pembayaran Warga -->
<div class="row g-4 mt-2">
    <div class="col-md-12">

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span><i class="bi bi-receipt me-2"></i> Laporan Pembayaran Warga</span>
            </div>

            <div class="card-body">

                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Warga</th>
                            <th>Tagihan</th>
                            <th>Bukti</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
@foreach($tagihans as $t)
    @php
        $payment = $t->payment;
    @endphp

<tr>
    {{-- WARGA --}}
    <td>
        <strong>{{ $t->user->name }}</strong><br>
        <small class="text-muted">{{ $t->user->email }}</small>
    </td>

    {{-- TAGIHAN --}}
    <td>
        <strong>{{ $t->nama_tagihan }}</strong><br>
        <small class="text-primary">
            Rp {{ number_format($t->nominal) }}
        </small>
    </td>

    {{-- BUKTI --}}
    <td>
        @if($payment && $payment->bukti_bayar)
            <a href="{{ asset('storage/'.$payment->bukti_bayar) }}"
               target="_blank"
               class="btn btn-outline-primary btn-sm rounded-pill">
                <i class="bi bi-image"></i> Lihat
            </a>
        @else
            <span class="text-muted fst-italic">Belum ada</span>
        @endif
    </td>

    {{-- STATUS --}}
<td>
    @if(!$payment)
        <span class="badge bg-secondary">Belum Bayar</span>

    @elseif($payment->status == 'pending')
        <span class="badge bg-warning text-dark">Pending</span>

    @elseif($payment->status == 'verified')
        <span class="badge bg-success">Lunas</span>

    @elseif($payment->status == 'rejected')
        <span class="badge bg-danger">Rejected</span>

    @endif
</td>


    {{-- AKSI --}}
    <td class="text-center">
        @if($payment && $payment->status == 'pending')

        <form action="{{ route('payment.verify', $payment->id) }}"
              method="POST" class="d-inline">
            @csrf
            <button class="btn btn-success btn-sm">
                ✔ Approve
            </button>
        </form>

        <button class="btn btn-danger btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#rejectModal{{ $payment->id }}">
            ✖ Decline
        </button>

        @else
            —
        @endif
    </td>
</tr>

{{-- MODAL REJECT --}}
@if($payment)
<div class="modal fade" id="rejectModal{{ $payment->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('payment.reject', $payment->id) }}" method="POST">
                @csrf
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Tolak Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">Catatan Penolakan</label>
                    <textarea name="catatan" class="form-control" required></textarea>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-danger">✖ Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endforeach
</tbody>
                </table>

            </div>
        </div>

    </div>
</div>

    </div>

</div>

<script>
    setTimeout(() => {
        document.querySelectorAll('.auto-alert').forEach(alert => {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 4000);
</script>

@endsection
