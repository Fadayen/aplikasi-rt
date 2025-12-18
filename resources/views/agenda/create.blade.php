@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold">Tambah Agenda</h2>

    <div class="card shadow mt-3">
        <div class="card-body">
            <form action="{{ route('agenda.store') }}" method="POST">
    @csrf


                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <button class="btn btn-primary">Simpan</button>
                <a href="/dashboard/admin" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
