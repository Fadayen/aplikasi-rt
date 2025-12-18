@extends('layouts.app')

@section('content')

<style>
/* ============================
   GLOBAL CARD STYLE
============================ */
.card-modern {
    border-radius: 16px;
    border: none;
    background: #ffffff;
    box-shadow: 0px 6px 22px rgba(0,0,0,0.08);
    overflow: hidden;
}

/* ============================
   HEADER GRADIENT
============================ */
.header-gradient {
    background: linear-gradient(135deg, #0072ff, #00d4b5);
    padding: 18px 22px;
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 19px;
    font-weight: 700;
}

/* ============================
   BUTTON ADD (+)
============================ */
.btn-add {
    padding: 8px 16px;
    background: rgba(255,255,255,0.3);
    border-radius: 10px;
    font-weight: 600;
    border: none;
    backdrop-filter: blur(6px);
    color: white;
    transition: .25s;
}

.btn-add:hover {
    background: rgba(255,255,255,0.45);
    transform: translateY(-2px);
}

/* ============================
   TABLE STYLE
============================ */
.table thead {
    background: linear-gradient(135deg, #1d3557, #457b9d);
    color: #fff;
    font-size: 14px;
}

.table tbody tr {
    transition: 0.2s;
}

.table tbody tr:hover {
    background: #f5f9ff;
}

.table td, .table th {
    vertical-align: middle;
    font-size: 14px;
}

/* ============================
   BADGES
============================ */
.badge-status {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

/* ============================
   PREMIUM BUTTONS
============================ */
.btn-download {
    background: linear-gradient(135deg, #00c6ff, #00ff9d);
    color: #fff;
    padding: 6px 14px;
    border-radius: 20px;
    border: none;
    font-weight: 600;
    font-size: 12px;
    transition: .25s;
}

.btn-download:hover {
    opacity: .85;
    transform: translateY(-2px);
}

.btn-edit {
    background: linear-gradient(135deg, #374785, #24305e);
    color: #fff !important;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    border: none;
    transition: .25s;
}

.btn-edit:hover {
    transform: translateY(-2px);
    opacity: .9;
}

.btn-delete {
    background: linear-gradient(135deg, #d00000, #ff4242);
    color: white;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    border: none;
    transition: .25s;
}

.btn-delete:hover {
    transform: translateY(-2px);
    opacity: .85;
}

/* ============================
   FILTER BOX
============================ */
.filter-box {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .filter-box { flex-direction: column; }
}

</style>


{{-- ============================
   FILTER SECTION
============================ --}}
<form method="GET" class="filter-box">
    <input type="text" name="search" placeholder="Cari nama / no surat"
        class="form-control" value="{{ request('search') }}">

    <select name="status" class="form-control">
        <option value="">Semua Status</option>
        <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
        <option value="validated" {{ request('status')=='validated'?'selected':'' }}>Validated</option>
    </select>

    <button class="btn btn-primary px-4">Filter</button>
</form>



{{-- ============================
   CARD WRAPPER
============================ --}}
<div class="card-modern">

    <div class="header-gradient">
        <span><i class="bi bi-file-earmark-text me-2"></i> Data Surat</span>

        <a href="{{ route('surat.create') }}" 
   class="btn btn-primary px-3 py-1" 
   style="font-size: 14px; border-radius: 6px;">
   + Tambah Surat
</a>

    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover table-bordered">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Surat</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>Tanggal</th>
                        <th>Status Kawin</th>
                        <th>Pelayanan</th>
                        <th>Pekerjaan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($surat as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $s->no_surat }}</td>
                        <td>{{ $s->username }}</td>
                        <td>{{ $s->alamat }}</td>
                        <td>{{ $s->tanggal }}</td>
                        <td>{{ $s->status_kawin }}</td>
                        <td>{{ $s->pelayanan }}</td>
                        <td>{{ $s->pekerjaan }}</td>

                        <td>
                            @if($s->status == 'pending')
                                <span class="badge-status bg-warning text-dark">Menunggu</span>
                            @else
                                <span class="badge-status bg-success text-white">Selesai</span>
                            @endif
                        </td>

                        <td class="d-flex gap-2">

                            {{-- DOWNLOAD --}}
                            @if($s->file_surat)
                                <a href="{{ route('surat.download', $s->id) }}" class="btn-download">
                                    Download
                                </a>
                            @else
                                <span class="badge bg-secondary d-flex justify-content-center align-items-center" 
      style="width: 70px; height: 30px;">
    No File
</span>

                            @endif


                            {{-- ADMIN ONLY --}}
                            @if(auth()->user()->role == 'admin')

                                {{-- EDIT --}}
                                @if($s->status == 'pending')
                                <a href="{{ route('surat.edit', $s->id) }}" class="btn-edit">
                                    Edit
                                </a>
                                @endif

                                {{-- DELETE --}}
                                <form action="{{ route('surat.destroy', $s->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-delete">Hapus</button>
                                </form>

                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection
