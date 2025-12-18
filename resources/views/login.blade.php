<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Aplikasi RT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background: #e9eef4;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .frame {
            background: white;
            width: 900px;
            height: 520px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px;
        }

        .inner-box {
            background: #f6f7f9;
            width: 100%;
            height: 100%;
            border-radius: 15px;
            padding: 50px;
        }

        .login-card {
            background: white;
            padding: 35px;
            border-radius: 10px;
            width: 380px;
            margin: auto;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .eye-icon {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            user-select: none;
            font-size: 18px;
            color: #666;
        }

        .eye-icon:hover {
            color: #000;
        }

        .register-link {
            font-size: 14px;
            margin-top: 15px;
            display: block;
            text-align: right;
        }
    </style>
</head>
<body>

<div class="frame">
    <div class="inner-box">

        <h2 class="text-center mb-4 fw-semibold">APLIKASI RT</h2>

        <div class="login-card">

            <p class="text-center mb-3 text-muted">Sign in to start your session</p>

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
                        type="email" 
                        name="email" 
                        class="form-control" 
                        placeholder="Email"
                        required
                    >
                </div>

                {{-- Password --}}
                <div class="mb-3 position-relative">
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

                <button type="submit" class="btn btn-primary w-100">
                    Login
                </button>

                <a href="{{ url('/register') }}" class="register-link">
                    Register Warga
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
