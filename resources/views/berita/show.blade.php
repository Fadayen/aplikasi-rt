@extends('layouts.app')

@section('content')

<style>
.detail-container {
    background: linear-gradient(135deg, #ffffff);
    padding: 20px 10px; /* ↓ lebih tipis */
    display: flex;
    justify-content: center;
}

.detail-box {
    background: #ffffff;
    width: 92%;
    max-width: 1100px;
    border-radius: 20px; /* ↓ radius lebih kecil */
    padding: 0;
    overflow: hidden;
    box-shadow: 0 4px 25px rgba(0,0,0,0.08); /* ↓ shadow ringan */
}

/* HEADER CARD */
.detail-header {
    background: linear-gradient(120deg, #0099cc, #00d4b0);
    padding: 18px 15px 25px; /* ↓ lebih tipis */
    text-align: center;
    color: white;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
    box-shadow: 0 4px 15px rgba(0, 180, 160, 0.2);
}

.detail-title {
    font-size: 26px; /* ↓ lebih kecil sedikit */
    font-weight: 800;
    letter-spacing: 0.5px;
    color: white;
}

.line {
    width: 80px;
    height: 3px;
    background: rgba(255,255,255,0.9);
    margin: 10px auto 0 auto;
    border-radius: 3px;
}

/* CONTENT */
.detail-content {
    padding: 22px; /* ↓ lebih tipis */
}


.berita-header {
    font-size: 13px;
    color: #666;
    margin-bottom: 15px;
}

.berita-judul {
    font-size: 28px;
    font-weight: 900;
    color: #0d2740;
    margin-bottom: 18px;
    line-height: 1.3;
}

.berita-isi {
    font-size: 16px;
    color: #2c2c2c;
    line-height: 1.8;
    margin-top: 10px;
}

/* KOMENTAR */
.komentar-box {
    background: #f9f9f9;
    border-radius: 18px;
    padding: 20px;
    margin-top: 35px;
    border: 1px solid #eee;
}

.komentar-title {
    font-size: 18px;
    font-weight: 800;
    margin-bottom: 15px;
}

.komentar-item {
    padding: 12px 0;
    border-bottom: 1px solid #e1e1e1;
    font-size: 15px;
}

.komentar-item:last-child {
    border-bottom: none;
}

.komentar-item b {
    color: #0099cc;
}

/* INPUT STYLE */
.input-wrapper {
    margin-top: 15px;
    display: flex;
    gap: 12px;
    border: 2px solid #00d4b0;
    border-radius: 15px;
    padding: 8px 12px;
    background: #e6fffa;
}

.input-wrapper input {
    border: none;
    background: transparent;
    width: 100%;
    outline: none;
    font-size: 15px;
}

.btn-send {
    background: linear-gradient(120deg, #00b4a8, #00e4cc);
    color: white;
    padding: 8px 18px;
    border-radius: 10px;
    border: none;
    font-weight: 700;
    cursor: pointer;
    transition: 0.2s;
}

.btn-send:hover {
    transform: scale(1.05);
    box-shadow: 0 0 10px #ffffff;
}
</style>


<a href="/berita" class="btn btn-secondary mb-3">← Kembali</a>
<div class="detail-container">
    <div class="detail-box">
        <div class="detail-header">
    <div class="detail-title">DETAIL BERITA</div>
    <div class="line"></div>
</div>

<div class="detail-content">


        {{-- HEADER --}}
        <div class="berita-header">
            {{ $data->penulis }} &nbsp;
            {{ $data->created_at->format('Y-m-d H:i:s') }}
        </div>

        {{-- GAMBAR --}}
        @if($data->gambar)
            <img src="{{ asset('storage/' . $data->gambar) }}"
                 style="width:100%; max-height:350px; object-fit:cover; border-radius:15px; margin-bottom:15px;">
        @endif

        {{-- JUDUL --}}
        <div class="berita-judul">{{ $data->judul }}</div>

        {{-- ISI --}}
        <div class="berita-isi">{!! nl2br(e($data->isi)) !!}</div>

        {{-- KOMENTAR --}}
        <div class="komentar-box">

            {{-- DAFTAR KOMENTAR --}}
            @foreach($komentar as $k)
                <div class="komentar-item">
                    <b>{{ $k->nama }}</b>  
                    {{ $k->created_at->format('Y-m-d H:i:s') }} <br>
                    {{ $k->isi }}
                </div>
            @endforeach

            {{-- FORM KIRIM KOMENTAR --}}
            <form action="{{ url('/berita/'.$data->id.'/komentar') }}" method="POST">
                @csrf
                <div class="input-wrapper">
                    <input type="text" name="isi" placeholder="Type Message ..." required>
                    <button class="btn-send">Kirim</button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection
