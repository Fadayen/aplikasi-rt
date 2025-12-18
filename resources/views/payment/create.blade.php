@extends('layouts.app')

@section('content')

<style>
.payment-card {
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
    border: none;
    overflow: hidden;
}

.card-header-custom {
    background: linear-gradient(120deg, #0099cc, #00d4b0);
    color: #fff;
    padding: 18px 24px;
}

.card-header-custom h5 {
    margin: 0;
    font-weight: 700;
}

.label {
    font-weight: 600;
}

.btn-upload {
    background: linear-gradient(120deg,#0ea5e9,#14b8a6);
    color: #fff;
    border-radius: 25px;
    padding: 8px 24px;
    font-weight: 600;
}

.btn-upload:hover {
    opacity: .9;
    color: #fff;
}
</style>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card payment-card">

                <!-- HEADER -->
                <div class="card-header card-header-custom">
                    <h5>💳 Pembayaran Tagihan</h5>
                </div>

                <!-- BODY -->
                <div class="card-body p-4">

                    <div class="mb-3">
                        <label class="label">Nama Tagihan</label>
                        <div class="form-control bg-light">
                            {{ $tagihan->nama_tagihan }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="label">Nominal</label>
                        <div class="form-control bg-light text-primary fw-semibold">
                            Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="label">Jatuh Tempo</label>
                        <div class="form-control bg-light">
                            {{ \Carbon\Carbon::parse($tagihan->jatuh_tempo)->format('d M Y') }}
                        </div>
                    </div>

                    <hr>

                    <!-- FORM UPLOAD -->
                    <form action="{{ route('payment.upload', $tagihan->id) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="label">Upload Bukti Pembayaran</label>
                            <input type="file"
                                   name="bukti_bayar"
                                   class="form-control @error('bukti_bayar') is-invalid @enderror"
                                   required>

                            @error('bukti_bayar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <a href="{{ route('tagihan.index') }}" class="btn btn-secondary rounded-pill px-4">
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-upload ms-2">
                                Upload Bukti
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
