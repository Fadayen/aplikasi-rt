@extends('layouts.app')

@section('content')
<style>
    .finance-wrapper {
        max-width: 1000px;
        margin: auto;
        padding: 10px;
    }

    .finance-box {
        background: #fff;
        border-radius: 18px;
        padding: 35px 40px;
        box-shadow: 0px 10px 25px rgba(0,0,0,0.08);
        border: 1px solid #e4e4e4;
    }

    @media (max-width: 768px) {
        .finance-box {
            padding: 20px;
            border-radius: 14px;
        }
    }

    .finance-title {
        text-align: center;
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 10px;
        letter-spacing: 1px;
    }

    .underline-title {
        width: 120px;
        height: 3px;
        background: #1c3d5a;
        margin: 10px auto 30px auto;
        border-radius: 2px;
    }

    .table-custom {
        border: 1px solid #dcdcdc;
        font-size: 15px;
        width: 100%;
    }

    @media (max-width: 480px) {
        .table-custom {
            font-size: 13px;
        }
    }

    .table-custom th {
        background: #f3f6f9;
        font-weight: 600;
        text-align: center;
        white-space: nowrap;
    }

    .total-row td {
        font-weight: 700;
    }

    .bg-income {
        background: #2ecc71 !important;
        color: white !important;
        text-align: center;
        font-weight: bold;
        white-space: nowrap;
    }

    .bg-expense {
        background: #e74c3c !important;
        color: white !important;
        text-align: center;
        font-weight: bold;
        white-space: nowrap;
    }

    .bg-saldo {
        background: #2e5ce6 !important;
        color: white !important;
        text-align: center;
        font-weight: bold;
        font-size: 17px;
    }

    @media (max-width: 480px) {
        .bg-saldo {
            font-size: 15px;
        }
    }

    .btn-detail {
        background: #32bcd4;
        color: white;
        font-weight: 600;
        padding: 5px 15px;
        border-radius: 6px;
    }

    /* Tabel responsif */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
</style>

<div class="container mt-4 finance-wrapper">

    <div class="finance-box">

        <h5 class="mb-3"><b>Data Keuangan</b></h5>

        <form method="GET" action="{{ url('/keuangan') }}" class="row g-3 mb-4">

    <div class="col-md-4 col-6">
        <select name="bulan" class="form-select">
            <option value="">-- Pilih Bulan --</option>
            @foreach(range(1,12) as $b)
                <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($b)->translatedFormat('F') }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4 col-6">
        <select name="tahun" class="form-select">
            <option value="">-- Pilih Tahun --</option>
            @for($t = 2035; $t >= 2020; $t--)
    <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>
        {{ $t }}
    </option>
@endfor

        </select>
    </div>

    <div class="col-md-4 col-12 d-flex gap-2">
        <button class="btn btn-primary w-100">🔍 Filter</button>
        <a href="{{ url('/keuangan') }}" class="btn btn-secondary w-100">♻ Reset</a>
    </div>

</form>


        <div class="table-responsive">
            <table class="table table-bordered table-custom">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Uraian</th>
                        <th>Uang Masuk</th>
                        <th>Uang Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $totalMasuk = 0;
                        $totalKeluar = 0;
                    @endphp

                    @foreach($data as $item)
                    @php 
                        if($item->jenis == 'pemasukan'){
                            $totalMasuk += $item->jumlah;
                        } else {
                            $totalKeluar += $item->jumlah;
                        }
                    @endphp

                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $item->tanggal }}</td>
                        <td>{{ $item->kegiatan }}</td>
                        <td class="text-center">
                            {{ $item->jenis == 'pemasukan' ? number_format($item->jumlah, 0, ',', '.') : '0' }}
                        </td>
                        <td class="text-center">
                            {{ $item->jenis == 'pengeluaran' ? number_format($item->jumlah, 0, ',', '.') : '0' }}
                        </td>
                    </tr>
                    @endforeach

                    <!-- Total -->
                    <tr class="total-row">
                        <td colspan="3"><b>Total Uang Masuk & Keluar</b></td>
                        <td class="bg-income">Rp {{ number_format($totalMasuk,0,',','.') }}</td>
                        <td class="bg-expense">Rp {{ number_format($totalKeluar,0,',','.') }}</td>
                    </tr>

                    <!-- Saldo -->
                    <tr>
                        <td colspan="5" class="bg-saldo">
                            Rp {{ number_format($totalMasuk - $totalKeluar, 0, ',', '.') }}
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>

</div>
@endsection
