@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">
            <i class="bi bi-gear-fill me-2"></i>
            Settings Tagihan
        </h5>
    </div>

    <div class="card-body">
        @foreach($tagihan as $item)
        <form method="POST" action="{{ url('/settings/tagihan/'.$item->id) }}" class="mb-4">
            @csrf

            <h6 class="fw-bold">{{ $item->nama_tagihan }}</h6>

            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Nominal Biasa</label>
                    <input type="number" name="nominal_biasa"
                           class="form-control"
                           value="{{ $item->nominal_biasa }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Nominal VIP</label>
                    <input type="number" name="nominal_vip"
                           class="form-control"
                           value="{{ $item->nominal_vip }}">
                </div>

                <div class="col-md-2 d-flex align-items-center mt-4">
                    <div class="form-check">
                        <input class="form-check-input"
                               type="checkbox"
                               name="aktif"
                               value="1"
                               {{ $item->aktif ? 'checked' : '' }}>
                        <label class="form-check-label">
                            Aktif
                        </label>
                    </div>
                </div>

                <div class="col-md-2 d-flex align-items-center mt-4">
                    <button class="btn btn-success w-100">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
        <hr>
        @endforeach
    </div>
</div>
@endsection
