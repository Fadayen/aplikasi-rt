@extends('layouts.app')

@section('content')

<style>
    /* ===== GLOBAL ===== */
    .card {
        border-radius: 1.2rem;
    }

    /* ===== HEADER ===== */
    .page-header {
        background: linear-gradient(120deg, #0099cc, #00d4b0);
        color: white;
        padding: 16px 24px;
        border-radius: 1.2rem 1.2rem 0 0;
    }

    /* ===== SEARCH ===== */
    .search-box input {
        border-radius: 30px;
        padding-left: 20px;
    }

    /* ===== TABLE ===== */
    .table thead {
        background: #f8fafc;
    }

    .table th {
        font-weight: 600;
        color: #555;
        border-bottom: none;
    }

    .table td {
        vertical-align: middle;
        border-top: 1px solid #f0f0f0;
    }

    .table tbody tr:hover {
        background-color: #f9fefe;
    }

    /* ===== ACTION BUTTON ===== */
    .btn-action {
        border-radius: 20px;
        font-size: 13px;
        padding: 4px 14px;
        font-weight: 600;
        transition: 0.25s;
    }
    .btn-action:hover {
        transform: translateY(-1px);
    }

    /* ===== TAGIHAN BUTTON ===== */
    .btn-tagihan {
        background: linear-gradient(90deg, #00c6ff, #00ff9d);
        color: white;
    }
    .btn-tagihan:hover {
        opacity: .9;
    }

    /* ===== TABLE CONTAINER ===== */
    .table-wrapper {
        border: 1px solid #eaecef;
        border-radius: 12px;
        overflow: hidden;
        width: 100%;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 992px) {
        .page-header h5 {
            font-size: 16px;
        }

        .btn-action {
            font-size: 12px;
            padding: 4px 10px;
        }

        .btn-tagihan {
            font-size: 12px;
        }
    }

    @media (max-width: 768px) {

        /* Wrapper untuk scroll horizontal tabel */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .search-box {
            flex-direction: column;
        }

        .search-box input {
            width: 100%;
        }

        .search-box button {
            width: 100%;
        }

        /* Membuat header lebih kecil */
        .page-header {
            padding: 12px 18px;
        }
        .page-header h5 {
            font-size: 15px;
        }

        /* Tombol aksi jadi rapat */
        .btn-action {
            margin-bottom: 4px;
            width: 100%;
        }

        .table th,
        .table td {
            font-size: 12px;
            white-space: nowrap;
        }

        .table td .d-flex {
            flex-direction: column;
            gap: 4px;
        }

        td.text-center {
            min-width: 130px;
        }
    }

    @media (max-width: 576px) {

        .container {
            padding: 12px;
        }

        .btn-action {
            font-size: 11px;
            padding: 4px 8px;
        }

        .page-header h5 {
            font-size: 14px;
        }
    }

    /* ===============================
   TAGIHAN MASSAL ADMIN
================================ */
.tagihan-massal-card {
    border-radius: 18px;
    box-shadow: 0 12px 30px rgba(0,0,0,.08);
    background: linear-gradient(180deg, #ffffff, #f9fafb);
}

.tagihan-massal-card .form-label {
    font-size: 14px;
    color: #374151;
}

.tagihan-massal-card .form-select,
.tagihan-massal-card .form-control {
    font-size: 14px;
    padding: 10px 18px;
}

.tagihan-massal-card button {
    padding: 10px 0;
    font-size: 14px;
    box-shadow: 0 8px 20px rgba(34,197,94,.35);
}

@media (max-width: 768px) {
    .tagihan-massal-card h6 {
        text-align: center;
    }
}

</style>

@if(session('success'))
<div id="successAlert"
     class="alert alert-success alert-dismissible fade show shadow-sm rounded-3"
     role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>

<script>
    setTimeout(() => {
        const alert = document.getElementById('successAlert');
        if (alert) {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 300);
        }
    }, 3000);
</script>
@endif



<div class="container">

    <div class="card shadow-sm border-0">

        {{-- HEADER --}}
        <div class="page-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-people-fill me-2"></i> Daftar Warga
            </h5>
        </div>

        <div class="card-body">

            {{-- FILTER --}}
            <form method="GET" class="search-box d-flex gap-2 mb-4">
                <input type="text" name="search" class="form-control"
                    placeholder="🔍 Cari nama"
                    value="{{ request('search') }}">

                <button class="btn btn-primary px-4 rounded-pill fw-semibold">
                    Search
                </button>
            </form>

            {{-- TAGIHAN MASSAL (ADMIN) --}}
@if(auth()->user()->role == 'admin')
<div class="card tagihan-massal-card mb-4 border-0">
    <div class="card-body">

        <form action="{{ route('tagihan.massal') }}" method="POST"
              class="row g-3 align-items-end">
            @csrf

            {{-- MASTER TAGIHAN --}}
            <div class="col-md-4">
                <label class="form-label fw-semibold">Master Tagihan</label>
                <select name="master_id" class="form-select rounded-pill" required>
                    <option value="">Pilih Master Tagihan</option>
                    @foreach($masters as $m)
                        <option value="{{ $m->id }}">
                            {{ $m->nama_tagihan }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- TARGET --}}
            <div class="col-md-3">
                <label class="form-label fw-semibold">Target Warga</label>
                <select name="jenis_tagihan" class="form-select rounded-pill" required>
                    <option value="all">Semua Warga</option>
                    <option value="biasa">Biasa (Rp 50.000)</option>
                    <option value="vip">VIP (Rp 100.000)</option>
                </select>
            </div>

            {{-- JATUH TEMPO --}}
            <div class="col-md-3">
                <label class="form-label fw-semibold">Jatuh Tempo</label>
                <input type="date"
                       name="jatuh_tempo"
                       class="form-control rounded-pill"
                       required>
            </div>

            {{-- BUTTON --}}
            <div class="col-md-2 d-grid">
                <button type="submit"
    class="btn btn-success rounded-pill fw-semibold"
    onclick="return konfirmasiKirim(event, this)">
    <span class="text">Kirim</span>
    <span class="spinner-border spinner-border-sm d-none"></span>
</button>


            </div>

        </form>
    </div>
</div>
@endif


            {{-- TABLE --}}
            <div class="table-wrapper">
                <div class="table-responsive">

                    <table class="table mb-0 align-middle">
                        <thead>
    <tr>
        <th>Nama</th>
        <th>Jenis Kelamin</th>

        @if(auth()->user()->role === 'admin')
            <th>Kategori Rumah</th>
        @endif

        <th class="text-center" style="width:230px;">Aksi</th>
    </tr>
</thead>


                        <tbody>
@forelse($warga as $w)
<tr>
    <td class="fw-semibold">{{ $w->name }}</td>

    <td>
        <span class="badge bg-secondary-subtle text-dark rounded-pill px-3">
            {{ $w->jenis_kelamin }}
        </span>
    </td>

    @if(auth()->user()->role === 'admin')
<td>
    @if($w->jenis_tagihan === 'vip')
        <span class="badge bg-warning text-dark">VIP (Rp 100.000)</span>
    @elseif($w->jenis_tagihan === 'biasa')
        <span class="badge bg-info text-dark">Biasa (Rp 50.000)</span>
    @else
        <span class="badge bg-secondary">Belum ditentukan</span>
    @endif
</td>
@endif


    <td class="text-center">
        <div class="d-flex justify-content-center gap-1 flex-wrap">
            <a href="{{ url('/data-warga/'.$w->id) }}"
               class="btn btn-info btn-sm btn-action text-white">Detail</a>

            @if(auth()->user()->role == 'admin')
                <a href="{{ url('/data-warga/'.$w->id.'/edit') }}"
                   class="btn btn-warning btn-sm btn-action text-white">Edit</a>

                <form action="{{ url('/data-warga/'.$w->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm btn-action">Hapus</button>
                </form>

                <a href="{{ route('tagihan.create', $w->id) }}"
                   class="btn btn-sm btn-action btn-tagihan">+ Tagihan</a>
            @endif
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="4" class="text-center text-muted py-4">
        Data warga belum tersedia
    </td>
</tr>
@endforelse



</tbody>


</table>
</div>
</div>

</div>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function konfirmasiKirim(event, btn) {
    event.preventDefault();

    Swal.fire({
        title: 'Kirim Tagihan Massal?',
        text: 'Tagihan akan dikirim ke warga sesuai target',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Kirim',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {

            // loading
            btn.disabled = true;
            btn.querySelector('.text').classList.add('d-none');
            btn.querySelector('.spinner-border').classList.remove('d-none');

            btn.closest('form').submit();
        }
    });

    return false;
}
</script>


@endsection
