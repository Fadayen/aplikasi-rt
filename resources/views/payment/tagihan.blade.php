@extends('layouts.app')

@section('content')

<style>

/* =========================
   ALERT SUKSES
========================= */
.success-alert {
    display: flex;
    align-items: center;
    gap: 14px;
    max-width: 520px;
    margin: 0 auto 18px;
    padding: 14px 18px;
    border-radius: 14px;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: #fff;
    box-shadow: 0 10px 25px rgba(34,197,94,.25);
    animation: slideIn .4s ease;
}

.success-alert .icon {
    font-size: 26px;
}

.success-alert .text strong {
    font-size: 15px;
}

.success-alert .text div {
    font-size: 13px;
    opacity: .95;
}

@keyframes slideIn {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* =========================
   CARD
========================= */
.tagihan-card {
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,.07);
    border: none;
    overflow: hidden;
}

.card-header-gradient {
    background: linear-gradient(120deg, #0099cc, #00d4b0);
    color: #fff;
    font-weight: 700;
    font-size: 18px;
}

/* =========================
   TABEL
========================= */
.table thead th {
    background: #f1f9ff;
    font-weight: 700;
    color: #023047;
}

/* STATUS BADGE */
.badge-belum { background:#ff4d4f; padding:6px 14px; font-size:13px; }
.badge-lunas { background:#2ecc71; padding:6px 16px; font-size:13px; }
.badge-wait  { background:#facc15; color:#000; padding:6px 14px; font-size:13px; }

/* BUTTON */
.btn-bayar {
    background: linear-gradient(120deg,#0ea5e9,#14b8a6);
    color: #fff;
    border-radius: 20px;
    padding: 6px 18px;
    font-size: 13px;
    font-weight: 600;
}
.btn-bayar:hover { opacity:.9; color:#fff; }



/* =========================
     RESPONSIVE
========================= */

/* HP KECIL – padding mengecil */
@media (max-width: 576px) {
    .card-header-gradient {
        font-size: 16px;
        padding: 12px !important;
    }

    .success-alert {
        padding: 12px 14px;
        font-size: 13px;
    }

    table th, table td {
        font-size: 13px !important;
        white-space: nowrap;
    }

    .btn-bayar {
        padding: 5px 14px;
        font-size: 12px;
    }

    .badge-belum, .badge-lunas, .badge-wait {
        padding: 5px 10px;
        font-size: 12px;
    }
}

/* HP VERY SMALL – tombol jadi block (ke bawah) */
@media (max-width: 420px) {
    .btn-bayar {
        display: block;
        width: 100%;
        margin-top: 6px;
    }
}
</style>




<div class="container mt-4">

    {{-- ALERT SUKSES --}}
    @if(session('success'))
        <div id="alert" class="success-alert">
            <div class="icon">✅</div>
            <div class="text">
                <strong>Berhasil!</strong>
                <div>{{ session('success') }}</div>
            </div>
        </div>
    @endif


    {{-- CARD --}}
    <div class="card tagihan-card">
        <div class="card-header card-header-gradient d-flex align-items-center">
            <i class="bi bi-receipt-cutoff me-2 fs-5"></i>
            Daftar Tagihan Warga
        </div>

        <div class="card-body p-0">

            {{-- RESPONSIVE WRAPPER --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            @if(auth()->user()->role === 'admin')
                                <th>Nama Warga</th>
                            @endif
                            <th>Nama Tagihan</th>
                            <th>Nominal</th>
                            <th>Jatuh Tempo</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($tagihan as $t)
                            <tr>

                                {{-- NAMA USER UNTUK ADMIN --}}
                                @if(auth()->user()->role === 'admin')
                                    <td class="fw-semibold">{{ $t->user->name ?? '-' }}</td>
                                @endif

                                <td><strong>{{ $t->nama_tagihan }}</strong></td>

                                <td class="fw-semibold text-primary">
                                    Rp {{ number_format($t->nominal, 0, ',', '.') }}
                                </td>

                                <td>
                                    <i class="bi bi-calendar-event me-1"></i>
                                    {{ \Carbon\Carbon::parse($t->jatuh_tempo)->format('d M Y') }}
                                </td>

                                {{-- STATUS --}}
<td class="text-center">

    @if($t->payment)

        @if($t->payment->status === 'rejected')
            <span class="badge badge-belum">❌ Ditolak</span>

        @elseif($t->payment->status === 'pending')
            <span class="badge badge-wait">⏳ Menunggu Verifikasi</span>

        @elseif($t->payment->status === 'verified')
            <span class="badge badge-lunas">✅ Lunas</span>
        @endif

    @else
        <span class="badge badge-belum">Belum Bayar</span>
    @endif

</td>


                                {{-- AKSI --}}
<td class="text-center">

    {{-- WARGA --}}
    @if(auth()->user()->role !== 'admin')

        {{-- ADA DATA PAYMENT --}}
        @if($t->payment)

            @php
                $status = $t->payment->status;
            @endphp

            {{-- STATUS REJECTED --}}
            @if($status === 'rejected')

                {{-- HANYA TOMBOL UPLOAD ULANG --}}
                <a href="{{ route('payment.form', $t->id) }}"
                   class="btn btn-bayar btn-sm">
                    🔁 Upload Ulang Pembayaran
                </a>

            {{-- STATUS PENDING --}}
            @elseif($status === 'pending')

                {{-- Pending = tidak ada aksi --}}
                <span class="text-muted">-</span>

            {{-- STATUS APPROVED --}}
            @elseif($status === 'verified')

                {{-- Lunas = tidak ada aksi --}}
                <span class="text-muted">-</span>

            @endif

        {{-- TIDAK ADA PAYMENT = BELUM BAYAR --}}
        @else
            <a href="{{ route('payment.form', $t->id) }}" class="btn btn-bayar btn-sm">
                💳 Bayar Sekarang
            </a>
        @endif

    {{-- ADMIN --}}
    @else

        <form action="{{ route('tagihan.destroy', $t->id) }}"
              method="POST"
              onsubmit="return confirm('Hapus tagihan ini?')"
              class="d-inline">

            @csrf
            @method('DELETE')

            <button class="btn btn-danger btn-sm">🗑 Hapus</button>
        </form>

    @endif

</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    Belum ada tagihan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
    const alert = document.getElementById('alert');
    if (alert) {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 500);
        }, 3000);
    }
});
</script>

@endsection
