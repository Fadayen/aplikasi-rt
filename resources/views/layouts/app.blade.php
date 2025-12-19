<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APLIKASI RT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* FONT GLOBAL */
        body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    margin: 0;

    display: flex;
    flex-direction: column;
    min-height: 100vh;
}



        /* NAVBAR PREMIUM DENGAN GRADIEN DAN ANIMASI */
        .navbar-custom {
            background: linear-gradient(135deg, #ffffff 0%, #e6f7ff 100%);
            padding: 8px 14px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* BRAND DENGAN IKON */
        .navbar-brand {
            font-size: 26px;
            font-weight: 800;
            color: #0099cc !important;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .navbar-brand i {
            margin-right: 10px;
            color: #005f85;
        }

        /* MENU LINK DENGAN IKON DAN HOVER EFEK */
        .navbar-nav .nav-link {
            color: #005f85 !important;
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.3s ease;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 153, 204, 0.2), transparent);
            transition: left 0.5s;
        }

        .navbar-nav .nav-link:hover::before {
            left: 100%;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(0, 153, 204, 0.1);
            color: #0099cc !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 153, 204, 0.3);
        }

        .navbar-nav .nav-link i {
            margin-right: 8px;
        }

        /* ACTIVE STATE */
        .navbar-nav .nav-link.active {
            background: linear-gradient(135deg, #0099cc 0%, #005f85 100%);
            color: #fff !important;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 153, 204, 0.5);
        }

        /* DROPDOWN DENGAN ANIMASI */
        .dropdown-menu {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            animation: fadeInDown 0.3s ease;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item {
            padding: 12px 20px;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 2px 5px;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #e6f7ff 0%, #b3e0ff 100%);
            color: #0099cc;
            transform: translateX(5px);
        }

        /* MOBILE TOGGLER */
        .navbar-toggler {
            border: none;
            background: linear-gradient(135deg, #0099cc 0%, #005f85 100%);
            color: white;
            border-radius: 8px;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.5%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='m4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* CONTAINER UTAMA */
        .container {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin-top: 30px;
    /* backdrop-filter: blur(10px); */  <-- HAPUS
    animation: fadeInUp 0.5s ease;
}


        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* FOOTER */
        footer {
            background: linear-gradient(135deg, #0099cc 0%, #005f85 100%);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 170px;
            border-radius: 20px 20px 0 0;
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.1);
        }

        footer p {
            margin: 0;
            font-weight: 500;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .navbar-custom {
                padding: 15px 20px;
            }
            .navbar-brand {
                font-size: 20px;
            }
            .container {
                padding: 20px;
                margin-top: 20px;
            }
        }
    </style>
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">

        <!-- BRAND DENGAN IKON -->
        <a class="navbar-brand fw-bold" href="/dashboard">
            <i class="fas fa-home"></i> 
        </a>

        <!-- MOBILE BUTTON -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse" id="navbarNav">

            <!-- MENU TENGAH -->
            <ul class="navbar-nav mx-auto">

    @if (auth()->check() && auth()->user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link" href="/dashboard/admin">
                <i class="fas fa-cog"></i> ADMIN
            </a>
        </li>
    @endif

    <li class="nav-item">
        <a class="nav-link" href="/agenda">
            <i class="fas fa-calendar-alt"></i> AGENDA
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/berita">
            <i class="fas fa-newspaper"></i> BERITA
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/keuangan">
            <i class="fas fa-dollar-sign"></i> KEUANGAN
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/inventaris">
            <i class="fas fa-boxes"></i> INVENTARIS
        </a>
    </li>

    {{-- Berita Nasional HANYA saat login --}}
    @auth
    <li class="nav-item">
        <a class="nav-link text-primary" href="{{ url('/berita-detik') }}">
            <i class="fas fa-globe"></i> Berita Nasional
        </a>
    </li>
    @endauth

</ul>


            <!-- USER DROPDOWN -->
            <ul class="navbar-nav">

                @if (auth()->check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle"
                       href="#" id="userDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> {{ auth()->user()->name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="/profile">
                            <i class="fas fa-user-edit"></i> Profil
                        </a></li>
                        <li><a class="dropdown-item" href="/logout">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a></li>
                    </ul>
                </li>

                @else
                    

{{-- LOGIN --}}
<li class="nav-item">
    <a class="nav-link text-primary" href="/login">
        <i class="fas fa-sign-in-alt"></i> Login
    </a>
</li>

                @endif

            </ul>

        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<!-- FOOTER -->
<footer>
    <p>&copy; 2025 Aplikasi RT 04. Dibuat dengan ❤️ untuk masyarakat.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
