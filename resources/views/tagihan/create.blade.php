@extends('layouts.app')

@section('content')
<div class="container mt-4 mt-md-5">

    <div class="row justify-content-center px-2 px-md-0">
        <div class="col-12 col-md-8 col-lg-7">

            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4 py-3">
                    <h4 class="mb-0 text-center text-md-start">
                        <i class="bi bi-receipt-cutoff me-2"></i>
                        Kirim Tagihan ke Warga
                    </h4>
                </div>

                <div class="card-body p-3 p-md-4">

                    {{-- Info Warga --}}
                    <div class="alert alert-info d-flex align-items-center shadow-sm rounded-3">
                        <i class="bi bi-person-circle fs-3 me-3"></i>
                        <div class="fs-6">
                            Mengirim tagihan kepada:
                            <strong>{{ $warga->name }}</strong>
                        </div>
                    </div>

                    <form action="{{ route('tagihan.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="warga_id" value="{{ $warga->id }}">

                        {{-- Nama Tagihan --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Tagihan</label>
                            <input type="text"
                                   name="nama_tagihan"
                                   class="form-control form-control-lg shadow-sm"
                                   placeholder="Contoh: Iuran Kebersihan"
                                   required>
                        </div>

                        {{-- Nominal --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nominal</label>
                            <div class="input-group input-group-lg shadow-sm">
                                <span class="input-group-text">Rp</span>
                                <input type="number"
                                       name="nominal"
                                       class="form-control"
                                       placeholder="Contoh: 50000"
                                       required>
                            </div>
                        </div>

                        {{-- Jatuh Tempo --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jatuh Tempo</label>
                            <input type="date"
                                   name="jatuh_tempo"
                                   class="form-control form-control-lg shadow-sm"
                                   required>
                        </div>

                        {{-- Button --}}
                        <div class="text-center text-md-end mt-4">
                            <button class="btn btn-primary btn-lg px-4 shadow-sm rounded-3 w-100 w-md-auto">
                                <i class="bi bi-send-check me-2"></i>
                                Kirim Tagihan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

{{-- Bootstrap Icons --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@endsection
