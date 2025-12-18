@extends('layouts.app')

@section('content')
<style>
    .inventory-container {
        max-width: 900px;
        margin: auto;
    }

    .inventory-box {
        background: #fff;
        border-radius: 15px;
        overflow: hidden; /* Supaya header dan body menyatu */
        box-shadow: 0px 10px 25px rgba(0,0,0,0.08);
        border: 1px solid #e5e5e5;
    }

    .inventory-header {
        background: linear-gradient(120deg, #0099cc, #00d4b0);
        padding: 25px;
        color: white;
        text-align: center;
    }

    .inventory-header h2 {
        font-size: 28px;
        font-weight: 800;
        margin: 0;
        letter-spacing: 1px;
    }

    .inventory-content {
        padding: 35px 50px;
    }

    .inv-label {
        font-weight: 600;
        margin-bottom: 6px;
        color: #333;
    }

    .inv-field {
        width: 100%;
        background: #f4f7fa;
        border: 1px solid #d8d8d8;
        border-radius: 8px;
        padding: 10px 15px;
        margin-bottom: 18px;
        font-size: 15px;
    }
</style>

<div class="container mt-4 inventory-container">

    <a href="/inventaris" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="inventory-box">

        {{-- HEADER GRADIASI --}}
        <div class="inventory-header">
            <h2>DETAIL INVENTARIS</h2>
        </div>

        {{-- ISI --}}
        <div class="inventory-content">

            <div>
                <div class="inv-label">Nama</div>
                <div class="inv-field">{{ $item->nama_barang }}</div>
            </div>

            <div>
                <div class="inv-label">Tipe</div>
                <div class="inv-field">{{ $item->tipe }}</div>
            </div>

            <div>
                <div class="inv-label">Jumlah</div>
                <div class="inv-field">{{ $item->jumlah }}</div>
            </div>

            <div>
                <div class="inv-label">Lokasi</div>
                <div class="inv-field">{{ $item->lokasi }}</div>
            </div>

            <div>
                <div class="inv-label">Kondisi</div>
                <div class="inv-field">{{ ucfirst($item->kondisi) }}</div>
            </div>

            <div>
                <div class="inv-label">Tanggal Masuk</div>
                <div class="inv-field">{{ $item->tanggal_masuk }}</div>
            </div>

            @if($item->keterangan)
            <div>
                <div class="inv-label">Keterangan</div>
                <div class="inv-field">{{ $item->keterangan }}</div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
