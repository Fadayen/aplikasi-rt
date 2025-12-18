@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <a href="/keuangan" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="card shadow">
        <div class="card-body">

            <h3>{{ $data->kegiatan }}</h3>

            <p><b>Jumlah:</b> Rp {{ number_format($data->jumlah, 0, ',', '.') }}</p>
            <p><b>Jenis:</b> 
                <span class="{{ $data->jenis == 'pemasukan' ? 'text-success' : 'text-danger' }}">
                    {{ ucfirst($data->jenis) }}
                </span>
            </p>
            <p><b>Tanggal:</b> {{ $data->tanggal }}</p>

            @if ($data->keterangan)
            <p><b>Keterangan:</b> {{ $data->keterangan }}</p>
            @endif

        </div>
    </div>

</div>
@endsection
