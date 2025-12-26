@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-5">

    <div class="col-md-6">
        <div class="card shadow border-0 rounded-4">

            <div class="card-header text-white rounded-top-4"
     style="background: linear-gradient(135deg, #0099cc 0%, #005f85 100%);">
                <h5 class="mb-0">
                    <i class="bi bi-shield-lock-fill me-2"></i>
                    Ganti Password Baru
                </h5>
            </div>

            <div class="card-body p-4">

                <div class="alert alert-info border-0"
     style="background: rgba(0,153,204,0.1); color:#005f85;">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i>
                    Demi keamanan, silakan ganti password Anda sebelum melanjutkan.
                </div>

                {{-- ALERT ERROR --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <style>
.toggle-eye {
    position: absolute;
    right: 15px;
    top: 38px;
    cursor: pointer;
    color: #0d6efd;
    font-size: 18px;
    z-index: 999;
}
</style>


                <form method="POST" action="{{ route('password.change.submit') }}">
                    @csrf

                    {{-- PASSWORD BARU --}}
<div class="mb-3 position-relative">
    <label class="form-label">Password Baru</label>
    <input type="password"
           name="password"
           id="password"
           class="form-control pe-5"
           required
           minlength="6">

    <i class="fa-solid fa-eye toggle-eye"
   onclick="togglePassword('password', this)"></i>
</div>

{{-- KONFIRMASI PASSWORD --}}
<div class="mb-3 position-relative">
    <label class="form-label">Konfirmasi Password</label>
    <input type="password"
           name="password_confirmation"
           id="password_confirmation"
           class="form-control pe-5"
           required>

    <i class="fa-solid fa-eye toggle-eye"
   onclick="togglePassword('password_confirmation', this)"></i>

</div>


                    <button class="btn btn-danger w-100">
                        <i class="bi bi-check-circle-fill me-1"></i>
                        Simpan Password Baru
                    </button>
                </form>

            </div>
        </div>
    </div>

</div>

<script>
function togglePassword(inputId, icon) {
    const input = document.getElementById(inputId);

    if (!input) return;

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>

@endsection
