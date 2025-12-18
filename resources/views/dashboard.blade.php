@extends('layouts.app')

@section('content')

<style>
/* GLOBAL */
body {
    background: linear-gradient(140deg, #eef2f5, #dfe9f3);
    font-family: 'Poppins', sans-serif;
    overflow-x: hidden;
    position: relative;
}

/* PARTICLE BACKGROUND */
.particles {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: -2;
}

.particle {
    position: absolute;
    background: rgba(0, 140, 255, 0.3);
    border-radius: 50%;
    animation: floatParticle 10s infinite linear;
}

.particle:nth-child(1) { width: 10px; height: 10px; top: 10%; left: 10%; animation-delay: 0s; }
.particle:nth-child(2) { width: 15px; height: 15px; top: 20%; left: 80%; animation-delay: 2s; }
.particle:nth-child(3) { width: 8px; height: 8px; top: 70%; left: 20%; animation-delay: 4s; }
.particle:nth-child(4) { width: 12px; height: 12px; top: 50%; left: 60%; animation-delay: 6s; }
.particle:nth-child(5) { width: 6px; height: 6px; top: 80%; left: 90%; animation-delay: 8s; }

@keyframes floatParticle {
    0% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
    100% { transform: translateY(0) rotate(360deg); }
}

/* BACKGROUND ORNAMENT */
.bg-shapes::before,
.bg-shapes::after {
    content: "";
    position: absolute;
    width: 300px;
    height: 300px;
    border-radius: 50%;
    background: rgba(0, 140, 255, 0.2);
    filter: blur(100px);
    z-index: -1;
}

.bg-shapes::before {
    top: -100px;
    left: -150px;
}

.bg-shapes::after {
    bottom: -100px;
    right: -150px;
}

/* WELCOME SECTION */
.welcome-section {
    text-align: center;
    margin-bottom: 50px;
    padding: 30px;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    animation: fadeIn 1s ease;
}

.welcome-avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0077ff, #00c6b7);
    display: inline-block;
    margin-bottom: 15px;
    box-shadow: 0 5px 15px rgba(0, 140, 255, 0.3);
}

.welcome-title {
    font-size: 28px;
    font-weight: 700;
    color: #003b6a;
    margin-bottom: 10px;
}

.welcome-stats {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}

.stat-item {
    background: rgba(255, 255, 255, 0.9);
    padding: 10px 20px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    font-size: 14px;
    color: #555;
}

.stat-item strong {
    color: #0077ff;
}

/* DASHBOARD TITLE */
.dashboard-title {
    text-align: center;
    font-size: 36px;
    font-weight: 900;
    letter-spacing: 1px;
    margin-bottom: 45px;
    color: #003b6a;
    text-transform: uppercase;
    position: relative;
    animation: fadeDown 0.8s ease;
}

.dashboard-title::after {
    content: "";
    width: 170px;
    height: 6px;
    border-radius: 5px;
    background: linear-gradient(90deg, #00c6b7, #0077ff);
    display: block;
    margin: 10px auto 0;
}

/* CARD */
.card-menu {
    position: relative;
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(20px);
    border-radius: 25px;
    padding: 35px 25px;
    min-height: 260px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    border: 1px solid rgba(255,255,255,0.5);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    text-align: center;
    cursor: pointer;
    transform: translateY(30px);
    opacity: 0;
    animation: fadeUp 1s ease forwards;
    overflow: hidden;
}

.card-menu:nth-child(1) { animation-delay: 0.1s; }
.card-menu:nth-child(2) { animation-delay: 0.2s; }
.card-menu:nth-child(3) { animation-delay: 0.3s; }
.card-menu:nth-child(4) { animation-delay: 0.4s; }
.card-menu:nth-child(5) { animation-delay: 0.5s; }
.card-menu:nth-child(6) { animation-delay: 0.6s; }

.card-menu::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #0077ff, #00c6b7);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.card-menu:hover::before {
    transform: scaleX(1);
}

.card-menu:hover {
    transform: translateY(-15px) scale(1.05);
    box-shadow: 0 25px 60px rgba(0,0,0,0.3), 0 0 20px rgba(0, 140, 255, 0.4);
    background: rgba(255,255,255,0.95);
}

/* PREMIUM ICON */
.feature-icon {
    font-size: 65px;
    margin-bottom: 20px;
    background: linear-gradient(135deg, #0066ff, #00e0c7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: floatIcon 2s infinite ease-in-out;
    transition: transform 0.3s ease;
}

.card-menu:hover .feature-icon {
    transform: rotate(10deg) scale(1.1);
}

/* TEXT */
.card-title {
    font-size: 24px;
    font-weight: 800;
    margin-bottom: 10px;
    color: #003b6a;
}

.card-desc {
    font-size: 15px;
    color: #555;
    min-height: 55px;
    margin-bottom: 20px;
}

/* BUTTON */
.tampil-btn button {
    background: linear-gradient(120deg, #0077ff, #00c6b7);
    border: none;
    padding: 12px 35px;
    font-size: 15px;
    border-radius: 30px;
    color: white;
    font-weight: 700;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.tampil-btn button::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.tampil-btn button:hover::before {
    width: 300px;
    height: 300px;
}

.tampil-btn button:hover {
    transform: scale(1.1);
    box-shadow: 0 10px 25px rgba(0, 183, 255, 0.5);
}

/* ANIMATIONS */
@keyframes fadeUp {
    0% { transform: translateY(30px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}

@keyframes fadeDown {
    0% { transform: translateY(-20px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}

@keyframes fadeIn {
    0% { opacity: 0; }
    100% { opacity: 1; }
}

@keyframes floatIcon {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .welcome-stats {
        flex-direction: column;
        gap: 10px;
    }
    .card-menu {
        margin-bottom: 20px;
    }
    .dashboard-title {
        font-size: 28px;
    }
}
</style>

<div class="particles">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
</div>

<div class="bg-shapes"></div>

<!-- WELCOME SECTION -->
<div class="welcome-section">
    <div class="welcome-avatar">
        <i class="fas fa-user" style="font-size: 40px; color: white; line-height: 80px;"></i>
    </div>
    <h3 class="welcome-title">Selamat Datang, Warga RT 02!</h3>
    <p style="color: #666; margin-bottom: 20px;">Kelola data dan kegiatan Anda dengan mudah.</p>
    <div class="welcome-stats">
        <div class="stat-item">
    <strong>{{ $totalWarga }}</strong> Warga Terdaftar
</div>

<div class="stat-item">
    <strong>{{ $agendaBulanIni }}</strong> Agenda Bulan Ini
</div>

<div class="stat-item">
    <strong>{{ $tagihanTertunggak }}</strong> Tagihan Tertunggak
</div>

    </div>
</div>

<div class="container">
    <div class="row g-4">

        <!-- CARD 1 -->
        <div class="col-md-4">
            <div class="card-menu">
                <div class="feature-icon"><i class="fas fa-users"></i></div>
                <h5 class="card-title">DATA WARGA</h5>
                <p class="card-desc">Informasi lengkap data warga RT 02 secara real-time.</p>
                <a href="{{ url('data-warga') }}" class="tampil-btn"><button>👁 Tampil</button></a>
            </div>
        </div>

        <!-- CARD 2 -->
        <div class="col-md-4">
            <div class="card-menu">
                <div class="feature-icon"><i class="fas fa-envelope-open-text"></i></div>
                <h5 class="card-title">SURAT PENGANTAR</h5>
                <p class="card-desc">Ajukan surat online tanpa harus datang ke pengurus.</p>
                <a href="/surat" class="tampil-btn"><button>👁 Tampil</button></a>
            </div>
        </div>

        <!-- CARD 3 -->
        <div class="col-md-4">
            <div class="card-menu">
                <div class="feature-icon"><i class="fas fa-calendar-check"></i></div>
                <h5 class="card-title">AGENDA</h5>
                <p class="card-desc">Jadwal kegiatan & acara lingkungan RT 02.</p>
                <a href="/agenda" class="tampil-btn"><button>👁 Tampil</button></a>
            </div>
        </div>

        <!-- CARD 4 -->
        <div class="col-md-4">
            <div class="card-menu">
                <div class="feature-icon"><i class="fas fa-receipt"></i></div>
                <h5 class="card-title">TAGIHAN</h5>
                <p class="card-desc">Lihat tunggakan, upload bukti, dan cek status pembayaran.</p>
                <a href="/tagihan" class="tampil-btn"><button>👁 Tampil</button></a>
            </div>
        </div>

        <!-- CARD 5 -->
        <div class="col-md-4">
            <div class="card-menu">
                <div class="feature-icon"><i class="fas fa-wallet"></i></div>
                <h5 class="card-title">KEUANGAN</h5>
                <p class="card-desc">Laporan pemasukan & pengeluaran kas RT.</p>
                <a href="/keuangan" class="tampil-btn"><button>👁 Tampil</button></a>
            </div>
        </div>

        <!-- CARD 6 -->
        <div class="col-md-4">
            <div class="card-menu">
                <div class="feature-icon"><i class="fas fa-box"></i></div>
                <h5 class="card-title">INVENTARIS</h5>
                <p class="card-desc">Daftar inventaris RT yang dapat dipinjam warga.</p>
                <a href="/inventaris" class="tampil-btn"><button>👁 Tampil</button></a>
            </div>
        </div>

    </div>
</div>

@endsection