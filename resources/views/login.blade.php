<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Aplikasi RT</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Google Fonts untuk font yang lebih menarik -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
/* =========================
   GLOBAL BODY (BACKGROUND HD)
   ========================= */
body {
    font-family: 'Poppins', sans-serif;

    /* Overlay tipis agar teks tetap terbaca TANPA bikin blur */
    background-image:
        linear-gradient(rgba(0,0,0,.18), rgba(0,0,0,.18)),
        url("{{ asset('assets/img/bg-login.jpg') }}");

    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    background-attachment: scroll;

    height: 100vh;
    margin: 0;

    display: flex;
    align-items: center;
    justify-content: center;
}

/* =========================
   FRAME & ANIMASI
   ========================= */
.frame {
    background: transparent;
    backdrop-filter: none;
    box-shadow: none;
    padding: 0;
    animation: slideIn 1s ease-in-out;
    position: relative;
    z-index: 2;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(30px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* =========================
   INNER CONTAINER
   ========================= */
.inner-box {
    background: transparent;
    width: 100%;
    height: 100%;
    border-radius: 20px;
    padding: 50px;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

/* =========================
   LOGIN CARD (GLASS EFFECT)
   ========================= */
.login-card {
    background: rgba(255, 255, 255, 0.90);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);

    padding: 40px;
    border-radius: 20px;
    width: 100%;
    max-width: 400px;

    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.35);
    border: 1px solid rgba(255,255,255,0.3);

    transition: transform .3s ease, box-shadow .3s ease;
}

.login-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 40px 90px rgba(0,0,0,0.45);
}

/* =========================
   FORM INPUT
   ========================= */
.form-control {
    border-radius: 10px;
    border: 1px solid #ddd;
    padding: 12px 15px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-control:focus {
    border-color: #4a90e2;
    box-shadow: 0 0 15px rgba(74, 144, 226, 0.4);
}

/* =========================
   EYE ICON
   ========================= */
.eye-icon {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    cursor: pointer;
    user-select: none;
    font-size: 18px;
    color: #666;
    transition: color 0.3s ease, transform 0.2s ease;
}

.eye-icon:hover {
    color: #4a90e2;
    transform: translateY(-50%) scale(1.1);
}

/* =========================
   BUTTON
   ========================= */
.btn-primary {
    background: linear-gradient(135deg, #4a90e2, #357abd);
    border: none;
    border-radius: 25px;
    padding: 12px;
    font-weight: 600;

    transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
    box-shadow: 0 6px 20px rgba(74, 144, 226, 0.4);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #357abd, #4a90e2);
    transform: scale(1.05);
    box-shadow: 0 10px 30px rgba(74, 144, 226, 0.5);
}

/* =========================
   REGISTER LINK
   ========================= */
.register-link {
    font-size: 14px;
    margin-top: 20px;
    display: block;
    text-align: center;
    color: #4a90e2;
    text-decoration: none;
    transition: color 0.3s ease;
}

.register-link:hover {
    color: #357abd;
    text-decoration: underline;
}

/* =========================
   ALERT
   ========================= */
.alert {
    border-radius: 10px;
    animation: fadeInAlert 0.5s ease;
}

@keyframes fadeInAlert {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* =========================
   LARGE SCREEN (BIAR TAJAM)
   ========================= */
@media (min-width: 1920px) {
    body {
        background-size: 100%;
    }
}
</style>

</head>
<body>

<div class="frame">
    <div class="inner-box">
        <!-- Logo atau ikon untuk membuatnya lebih menarik -->

        <div class="login-card">
            <div class="text-center mb-4">
    <img 
        src="{{ asset('assets/img/favicon.ico') }}"
        alt="Fontania Metland Tambun"
        style="height: 80px;"
    >
</div>


            {{-- Pesan Error / Sukses --}}
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- FORM LOGIN --}}
            <form action="{{ route('login') }}" method="POST">
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <input 
                        type="text"
                        name="login"
                        class="form-control"
                        placeholder="Nama atau Email"
                        required
                    >
                </div>

                {{-- Password --}}
                <div class="mb-4 position-relative">
                    <input 
                        type="password" 
                        name="password" 
                        id="passwordField"
                        class="form-control" 
                        placeholder="Password" 
                        required
                    >
                    <i class="bi bi-eye-fill eye-icon" onclick="togglePassword(this)"></i>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </button>

                <a href="{{ url('/register') }}" class="register-link">
                    Belum punya akun? <strong>Daftar Warga</strong>
                </a>
            </form>
        </div>
    </div>
</div>

<!-- Script Show/Hide Password -->
<script>
function togglePassword(icon) {
    const field = document.getElementById("passwordField");

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