@extends('layouts.app')

@section('content')
<style>
    .inventory-wrapper {
        max-width: 1000px;
        margin: auto;
    }

    .inventory-box {
        background: #fff;
        border-radius: 18px;
        padding: 40px 50px;
        box-shadow: 0px 10px 25px rgba(0,0,0,0.08);
        border: 1px solid #e4e4e4;
    }

    .table-custom {
        border: 1px solid #dcdcdc;
        font-size: 15px;
        width: 100%;
    }

    .table-custom th {
        background: #f3f6f9;
        font-weight: 600;
        text-align: center;
        white-space: nowrap;
    }

    /* ===============================
       RESPONSIVE
    ================================= */
    @media (max-width: 768px) {

        .inventory-box {
            padding: 25px 20px;
        }

        .table-custom {
            font-size: 13px;
        }

        .table-custom th,
        .table-custom td {
            padding: 8px 10px;
            white-space: nowrap;
        }

        .card-header {
            font-size: 16px !important;
            text-align: center;
        }

        .btn-sm {
            padding: 4px 10px !important;
            font-size: 12px !important;
        }
    }

    @media (max-width: 576px) {

        .inventory-box {
            padding: 20px 15px;
        }

        .table-responsive {
            border-radius: 10px;
            overflow-x: scroll;
        }

        .btn-sm {
            padding: 3px 8px !important;
            font-size: 11px !important;
        }
    }
</style>

<div class="container mt-4 inventory-wrapper">
    <div class="inventory-box">

        <div class="card shadow-sm" style="border-radius: 12px; overflow:hidden;">

            <div class="card-header text-white fw-semibold"
                style="background: linear-gradient(120deg, #0099cc, #00d4b0); font-size:18px;">
                Data Inventaris
            </div>

            <div class="card-body p-4">

                <!-- ✅ WRAPPER BIAR RESPONSIF -->
                <div class="table-responsive">
                    <table class="table table-bordered table-custom">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Lokasi</th>
                                <th>Tanggal Beli</th>
                                <th>Keterangan</th>
                                <th style="width: 160px;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td class="text-center">{{ $item->jumlah }}</td>
                                <td class="text-center">{{ $item->lokasi ?? '-' }}</td>
                                <td class="text-center">{{ $item->tanggal_masuk }}</td>
                                <td>{{ $item->keterangan ?? '-' }}</td>

                                <td class="text-center">

                                    {{-- WARGA --}}
                                    @if(auth()->user()->role === 'warga')
                                        <a href="{{ route('inventaris.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    @endif

                                    {{-- ADMIN --}}
                                    @if(auth()->user()->role === 'admin')
                                        <a href="/inventaris/{{ $item->id }}/edit" class="btn btn-warning btn-sm"
                                            style="color:white; font-weight:600; border-radius:6px;">
                                            Edit
                                        </a>

                                        <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST"
                                            style="display:inline-block;"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?');">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm"
                                                style="color:white; font-weight:600; border-radius:6px;">
                                                Delete
                                            </button>
                                        </form>
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div> {{-- card-body --}}
        </div> {{-- card --}}

    </div> {{-- inventory-box --}}
</div> {{-- container --}}

@endsection
