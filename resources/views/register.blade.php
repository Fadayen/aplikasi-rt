<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Warga</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Google Fonts untuk font yang lebih menarik -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
/* =========================
   GLOBAL BODY (SCROLL AMAN)
   ========================= */
body {
    font-family: 'Poppins', sans-serif;

    background-image:
        linear-gradient(rgba(0,0,0,.15), rgba(0,0,0,.15)),
        url("{{ asset('assets/img/bg-login.jpg') }}");

    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    background-attachment: fixed;

    min-height: 100vh;          /* FIX SCROLL */
    margin: 0;

    display: flex;
    justify-content: center;
    align-items: flex-start;    /* PENTING */
    padding: 40px 15px;

    position: relative;
    overflow-x: hidden;
}

/* =========================
   PARTIKEL BACKGROUND (AMAN)
   ========================= */
body::after {
    content: '';
    position: fixed;            /* FIXED BIAR GAK IKUT SCROLL */
    inset: 0;
    background:
        radial-gradient(circle at 20% 80%, rgba(74,144,226,.1), transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(53,122,189,.1), transparent 50%);
    animation: floatParticles 25s linear infinite;
    pointer-events: none;
    z-index: 0;
}

@keyframes floatParticles {
    0% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0); }
}

/* =========================
   FRAME (KONTROL TINGGI)
   ========================= */
.frame {
    width: 100%;
    max-width: 1000px;
    position: relative;
    z-index: 1;
}

/* =========================
   INNER CONTAINER
   ========================= */
.inner-box {
    padding: 20px;
}

/* =========================
   REGISTER CARD (PROPORSIONAL)
   ========================= */
.register-card {
    background: rgba(255,255,255,.92);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);

    border-radius: 22px;
    padding: 30px;

    box-shadow: 0 25px 70px rgba(0,0,0,.35);
    border: 1px solid rgba(255,255,255,.35);

    animation: fadeUp .8s ease;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* =========================
   FORM TITLE
   ========================= */
.form-title {
    text-align: center;
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 25px;
    color: #333;
}

/* =========================
   FORM INPUT
   ========================= */
.form-control,
.form-select {
    border-radius: 12px;
    padding: 12px 16px;
    background: rgba(255,255,255,.85);
    border: 1px solid #ddd;
    transition: .3s;
}

.form-control:focus,
.form-select:focus {
    border-color: #4a90e2;
    box-shadow: 0 0 0 3px rgba(74,144,226,.25);
}

/* =========================
   ICON INPUT
   ========================= */
.input-group {
    position: relative;
}

.input-group .form-control,
.input-group .form-select {
    padding-left: 45px;
}

.input-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #4a90e2;
    z-index: 5;
}

/* =========================
   EYE ICON
   ========================= */
.eye-icon {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 18px;
    color: #666;
    transition: .3s;
}

.eye-icon:hover {
    color: #4a90e2;
}

/* =========================
   BUTTON
   ========================= */
.btn-primary {
    background: linear-gradient(135deg,#4a90e2,#357abd);
    border: none;
    border-radius: 30px;
    padding: 14px;
    font-weight: 700;
    letter-spacing: .5px;
    transition: .3s;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(74,144,226,.5);
}

/* =========================
   ALERT
   ========================= */
.alert {
    border-radius: 12px;
}

/* =========================
   RESPONSIVE
   ========================= */
@media (max-width: 768px) {
    body {
        padding: 20px 10px;
    }

    .register-card {
        padding: 25px;
    }

    .form-title {
        font-size: 22px;
    }
}

/* FIX ALIGN TEXTAREA DENGAN ICON */
textarea.form-control {
    padding-top: 12px;      /* biar teks sejajar */
    padding-left: 45px;     /* samakan dengan input */
    line-height: 1.5;
    resize: none;           /* opsional: biar rapi */
}

/* =========================
   LOGIN LINK
   ========================= */
.login-link {
    margin-top: 25px;
    text-align: center;
    font-size: 14px;
    color: #555;
}

.login-link a {
    color: #4a90e2;
    font-weight: 600;
    text-decoration: none;
    margin-left: 4px;
    position: relative;
    transition: .3s;
}

.login-link a::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -2px;
    width: 0;
    height: 2px;
    background: linear-gradient(135deg,#4a90e2,#357abd);
    transition: .3s;
}

.login-link a:hover {
    color: #357abd;
}

.login-link a:hover::after {
    width: 100%;
}


</style>


</head>

<body>

<div class="frame">
    <div class="inner-box">
        <div class="register-card">
            <h2 class="form-title">Register Warga</h2>

            {{-- Pesan Error / Sukses --}}
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('register.warga.process') }}" method="POST">

                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <i class="bi bi-person input-icon"></i>
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <div class="position-relative">
                            <div class="input-group">
                                <i class="bi bi-lock input-icon"></i>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                <i class="bi bi-eye-fill eye-icon" onclick="togglePassword('password', this)"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Password Konfirmasi -->
                    <div class="col-md-6">
                        <label class="form-label">Password Konfirmasi</label>
                        <div class="position-relative">
                            <div class="input-group">
                                <i class="bi bi-lock-fill input-icon"></i>
                                <input type="password" class="form-control" id="password2" name="password_confirmation" placeholder="Password Konfirmasi" required>
                                <i class="bi bi-eye-fill eye-icon" onclick="togglePassword('password2', this)"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nomor Kartu Keluarga</label>
                        <div class="input-group">
                            <i class="bi bi-card-text input-icon"></i>
                            <input type="text" class="form-control" name="no_kk" placeholder="Nomor Kartu Keluarga" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">NIK</label>
                        <div class="input-group">
                            <i class="bi bi-person-vcard input-icon"></i>
                            <input type="text" class="form-control" name="nik" placeholder="NIK" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <i class="bi bi-person-circle input-icon"></i>
                            <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir</label>
                        <div class="input-group">
                            <i class="bi bi-geo-alt input-icon"></i>
                            <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <div class="input-group">
                            <i class="bi bi-calendar-date input-icon"></i>
                            <input type="date" class="form-control" name="tanggal_lahir" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Agama</label>
                        <div class="input-group">
                            <i class="bi bi-star input-icon"></i>
                            <select class="form-select" name="agama" required>
                                <option value="">-- Pilih Agama --</option>
                                <option>Islam</option>
                                <option>Kristen</option>
                                <option>Katolik</option>
                                <option>Hindu</option>
                                <option>Buddha</option>
                                <option>Konghucu</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Jenis Kelamin</label>
                        <div class="input-group">
                            <i class="bi bi-gender-ambiguous input-icon"></i>
                            <select class="form-select" name="jenis_kelamin" required>
                                <option value="">-- Pilih --</option>
                                <option>Laki-laki</option>
                                <option>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nomor HP</label>
                        <div class="input-group">
                            <i class="bi bi-phone input-icon"></i>
                            <input type="text" class="form-control" name="no_hp" placeholder="Nomor HP" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Alamat Lengkap</label>
                        <div class="input-group">
                            <i class="bi bi-house-door input-icon"></i>
                            <textarea class="form-control" name="alamat" rows="3" placeholder="Alamat Lengkap" required></textarea>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary w-100 mt-4">
                    <i class="bi bi-person-plus me-2"></i>Register
                </button>

                <div class="login-link">
    <i class="bi bi-box-arrow-in-right me-1"></i>
    Sudah punya akun?
    <a href="{{ route('login') }}">Login di sini</a>
</div>


            </form>
        </div>
    </div>
</div>

<!-- JAVASCRIPT SHOW / HIDE PASSWORD -->
<script>
function togglePassword(id, icon) {
    const field = document.getElementById(id);

    if (field.type === "password") {
        field.type = "text";
        icon.classList.remove("bi-eye-fill");
        icon.classList.add("bi-eye-slash-fill");
    } else {
        field.type = "password";
        icon.classList.remove("bi-eye-slash-fill");
        icon.classList.add("bi-eye-fill");
    }
}
</script>

</body>
</html>