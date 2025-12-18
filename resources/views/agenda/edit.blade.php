@extends('layouts.app')

@section('content')

<div class="col-md-8 mx-auto mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <strong><i class="bi bi-pencil-square"></i> Edit Agenda</strong>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="/agenda/{{ $agenda->id }}/update" method="POST">
                @csrf

                <!-- Judul -->
                <div class="mb-3">
                    <label class="form-label">Judul Agenda</label>
                    <input type="text" name="judul" class="form-control" value="{{ $agenda->judul }}" required>
                </div>

                <!-- Tanggal -->
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ $agenda->tanggal }}" required>
                </div>

                <div class="d-flex justify-content-between mt-3">

                    <a href="/agenda" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Agenda
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection
