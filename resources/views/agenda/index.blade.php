@extends('layouts.app')

@section('content')

<style>
    /* Responsif tambahan */
    @media (max-width: 576px) {
        .card-header {
            font-size: 16px !important;
            text-align: center;
        }
        table thead th {
            font-size: 13px;
        }
        table tbody td {
            font-size: 13px;
        }
    }
</style>

<div class="card shadow-sm" style="border-radius: 12px; overflow:hidden;">

    <div class="card-header text-white fw-semibold"
         style="background: linear-gradient(120deg, #0099cc, #00d4b0); font-size:18px;">
        AGENDA
    </div>

    <div class="card-body p-4">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive"> 
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Judul</th>
                        <th style="width: 140px;">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agenda as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->tanggal }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada agenda</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
